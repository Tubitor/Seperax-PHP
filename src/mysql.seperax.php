<?php

/**
 * @version 1.0
 * @author Linus Benkner
 */

/**
 * MySQL
 * @since 1.0
 */

class MySQL
{

    private $pdo = null;
    private $success = false;

    public function __construct(string $host, string $database, string $username, string $password)
    {
        try {
            $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
            $this->success = true;
        } catch (PDOException $ex) {
        }
    }

    public function error(): bool
    {
        return !$this->success;
    }

    public function create_table(string $table, array $fields, string $primary_key = null): bool
    {
        $statement = "CREATE TABLE IF NOT EXISTS " . $table . " (" . implode(", ", $fields);
        if ($primary_key !== null) $statement .= ", PRIMARY KEY (" . $primary_key . ")";
        $statement .= ")";
        $execution = $this->pdo->prepare($statement);
        $result = $execution->execute();
        if ($result) return true;
        return false;
    }

    public function select(string $table, array $fields, array $where = [], array $options = []): object
    {
        $statement = "SELECT " . implode(", ", $fields) . " FROM " . $table;
        $vars = [];
        if (count($where) > 0) {
            $first = true;
            $statement .= ' WHERE';
            foreach ($where as $key => $val) {
                $vars[] = $val;
                if (!$first) $statement .= ' AND';
                $statement .= ' ' . $key . ' = ?';
                $first = false;
            }
        }
        if (isset($options['orderby'])) {
            $statement .= ' ORDER BY ' . implode(", ", $options['orderby']) . ($options['order'] === 'DESC' ? " DESC" : " ASC");
        }
        if (isset($options['limit']) && intval($options['limit'])) {
            if (isset($options['offset']) && intval($options['offset'])) {
                $statement .= ' LIMIT ' . intval($options['offset']) . ', ' . intval($options['limit']);
            } else {
                $statement .= ' LIMIT ' . intval($options['limit']);
            }
        }
        $execution = $this->pdo->prepare($statement);
        $execution->execute($vars);
        if ($execution->rowCount() > 0) {
            return (object) [
                "count" => $execution->rowCount(),
                "rows" => $execution->fetchAll()
            ];
        }
        return (object) ["count" => 0, "rows" => []];
    }

    public function insert(string $table, array $fields): bool
    {
        $statement = 'INSERT INTO ' . $table . ' (' . implode(', ', array_keys($fields));
        $vals = [];
        for ($i = 0; $i < count($fields); $i++) $vals[] = '?';
        $statement .= ') VALUES (' . implode(', ', $vals) . ')';
        $execution = $this->pdo->prepare($statement);
        $result = $execution->execute(array_values($fields));
        if ($result) return true;
        return false;
    }

    public function update(string $table, array $fields, array $where = [], array $options = []): bool
    {
        $statement = "UPDATE " . $table . " SET ";
        $updates = [];
        $vars = [];
        foreach ($fields as $key => $val) {
            $updates[] = $key . " = ?";
            $vars[] = $val;
        }
        $statement .= implode(", ", $updates);
        if (count($where) > 0) {
            $first = true;
            $statement .= ' WHERE';
            foreach ($where as $key => $val) {
                $vars[] = $val;
                if (!$first) $statement .= ' AND';
                $statement .= ' ' . $key . ' = ?';
                $first = false;
            }
        }
        if (isset($options['limit']) && intval($options['limit'])) {
            if (isset($options['offset']) && intval($options['offset'])) {
                $statement .= ' LIMIT ' . intval($options['offset']) . ', ' . intval($options['limit']);
            } else {
                $statement .= ' LIMIT ' . intval($options['limit']);
            }
        }
        $execution = $this->pdo->prepare($statement);
        $result = $execution->execute($vars);
        if ($result) return true;
        return false;
    }

    public function delete(string $table, array $where = [], array $options = []): bool
    {
        $statement = "DELETE FROM " . $table;
        $vars = [];
        if (count($where) > 0) {
            $first = true;
            $statement .= ' WHERE';
            foreach ($where as $key => $val) {
                $vars[] = $val;
                if (!$first) $statement .= ' AND';
                $statement .= ' ' . $key . ' = ?';
                $first = false;
            }
        }
        if (isset($options['orderby'])) {
            $statement .= ' ORDER BY ' . implode(", ", $options['orderby']) . ($options['order'] === 'DESC' ? " DESC" : " ASC");
        }
        if (isset($options['limit']) && intval($options['limit'])) {
            if (isset($options['offset']) && intval($options['offset'])) {
                $statement .= ' LIMIT ' . intval($options['offset']) . ', ' . intval($options['limit']);
            } else {
                $statement .= ' LIMIT ' . intval($options['limit']);
            }
        }
        $execution = $this->pdo->prepare($statement);
        $result = $execution->execute($vars);
        if ($result) return true;
        return false;
    }
}
