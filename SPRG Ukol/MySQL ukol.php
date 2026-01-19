<?php

class User
{
    public ?int $id = null;
    public string $name;
    public string $email;
    public ?string $password_hash = null;
    public string $created_at;

    private static PDO $pdo;

    public static function setConnection(PDO $pdo): void
    {
        self::$pdo = $pdo;
    }

    public static function find(int $id): ?self
    {
        $stmt = self::$pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return null;

        $user = new self();
        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password_hash = $data['password_hash'] ?? null;
        $user->created_at = $data['created_at'];

        return $user;
    }

    public function save(): bool
    {
        if ($this->id === null) {
            // INSERT
            $stmt = self::$pdo->prepare(
                "INSERT INTO users (name, email, password_hash, created_at)
                 VALUES (?, ?, ?, NOW())"
            );
            $ok = $stmt->execute([$this->name, $this->email, $this->password_hash]);
            if ($ok) $this->id = self::$pdo->lastInsertId();
            return $ok;
        }

        // UPDATE
        $stmt = self::$pdo->prepare(
            "UPDATE users SET name = ?, email = ?, password_hash = ? WHERE id = ?"
        );
        return $stmt->execute([$this->name, $this->email, $this->password_hash, $this->id]);
    }

    public function delete(): bool
    {
        if ($this->id === null) return false;

        $stmt = self::$pdo->prepare("DELETE FROM users WHERE id = ?");
        $ok = $stmt->execute([$this->id]);
        if ($ok) $this->id = null;
        return $ok;
    }
}

$pdo = new PDO("mysql:host=localhost;dbname=test;charset=utf8", "root", "");
User::setConnection($pdo);

/*
$user = new User();
$user->name = "Petr Nový";
$user->email = "petr@novy.cz";
$user->password_hash = password_hash("123456", PASSWORD_DEFAULT);
$user->save();

echo "Nový ID: " . $user->id . "<br>";

$found = User::find($user->id);
if ($found) {
    $found->name .= " (upraveno)";
    $found->save();
    $found->delete();
}
*/