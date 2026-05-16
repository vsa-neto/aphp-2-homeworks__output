<?php
declare(strict_types=1);

abstract class BaseTableWrapper implements DatabaseWrapper
{
    protected PDO $db;
    protected string $tableName;
    protected string $primaryKey;

    public function __construct(PDO $db, string $tableName, string $primaryKey = 'id')
    {
        $this->db = $db;
        $this->tableName = $tableName;
        $this->primaryKey = $primaryKey;
    }

    public function insert(array $tableColumns, array $values): array
    {
        $columnsStr = implode(', ', $tableColumns);
        $placeholders = implode(', ', array_fill(0, count($values), '?')); // "?,?,?"

        $sql = "INSERT INTO `{$this->tableName}` ($columnsStr) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($values);

        $lastId = (int)$this->db->lastInsertId();
        return $this->find($lastId);
    }

    public function update(int $id, array $values): array
    {
        $setParts = [];
        $bindValues = [];

        foreach ($values as $column => $value) {
            $setParts[] = "`{$column}` = ?";
            $bindValues[] = $value;
        }

        $setStr = implode(', ', $setParts);
        $bindValues[] = $id; // Для условия WHERE

        $sql = "UPDATE `{$this->tableName}` SET {$setStr} WHERE {$this->primaryKey} = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($bindValues);
        return $this->find($id);
    }

    public function find(int $id): array
    {
        $sql = "SELECT * FROM `{$this->tableName}` WHERE {$this->primaryKey} = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: [];
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM `{$this->tableName}` WHERE {$this->primaryKey} = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
