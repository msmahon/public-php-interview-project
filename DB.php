<?php
class DB {
    private $connection;

    public function __construct(string $db_file)
    {
        $this->connection = new PDO("sqlite:$db_file", null, null, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        ]);
    }

    public function get($statement, $params = [])
    {
        $query = $this->connection->prepare($statement);
        $query->execute($params);
        return $query->fetchAll(\PDO::FETCH_ASSOC); 
    }
}
