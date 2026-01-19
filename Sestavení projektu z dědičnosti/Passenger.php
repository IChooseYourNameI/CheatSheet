<?php

class Passenger
{
    public ?int $id = null;
    public string $name;
    public int $age;
    public string $ticketNumber;

    public function __construct(string $name, int $age, string $ticketNumber, ?int $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->ticketNumber = $ticketNumber;
    }

    public function introduce(): string
    {
        return "Jmenuji se {$this->name}, je mi {$this->age} let. Číslo jízdenky: {$this->ticketNumber}";
    }
}

class PassengerRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function save(Passenger $p): bool
    {
        if ($p->id === null) {
            $stmt = $this->pdo->prepare(
                "INSERT INTO passengers (name, age, ticket_number) VALUES (?,?,?)"
            );
            $ok = $stmt->execute([$p->name, $p->age, $p->ticketNumber]);
            if ($ok) $p->id = (int)$this->pdo->lastInsertId();
            return $ok;
        }

        $stmt = $this->pdo->prepare(
            "UPDATE passengers SET name=?, age=?, ticket_number=? WHERE id=?"
        );
        return $stmt->execute([$p->name, $p->age, $p->ticketNumber, $p->id]);
    }

    public function findById(int $id): ?Passenger
    {
        $stmt = $this->pdo->prepare("SELECT * FROM passengers WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Passenger($row['name'], $row['age'], $row['ticket_number'], $row['id']) : null;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM passengers WHERE id = ?");
        return $stmt->execute([$id]);
    }
}