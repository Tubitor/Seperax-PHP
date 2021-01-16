# MySQL Class

MySQL made easy with the Seperax-PHP MySQL-Class!

```
/**
 * MySQL
 * @since 1.0
 */
class MySQL
```

## Create connection

```
$database = new MySQL('hostname', 'database', 'username', 'password');
if($database->error()) {
    /* Whoops! There's an error! */
}else {
    /* Connection successfull */
}
```

Source:
```
public function __construct(string $host, string $database, string $username, string $password)
```

## Create a table

```
$database->create_table('tablename', [
    'ID INT NOT NULL',
    'NAME VARCHAR(20) NOT NULL',
    'AGE INT NOT NULL',
    'ADDRESS CHAR(25)'
], 'ID');
```

Source:
```
public function create_table(string $table, array $fields, string $primary_key = null): bool
```

## Insert

```
$database->insert('tablename', [
    'NAME' => 'Mr. Test',
    'AGE' => 20,
    'ADDRESS' => 'USA'
]);
```

Source:
```
public function insert(string $table, array $fields): bool
```

## Select

```
$result = $database->select('tablename',
    ['NAME', 'AGE'],
    ['ID' => 1]
);
if($result->count > 0) {
    $row = $result->rows[0];
    $name = $row['NAME'];
    $age = $row['AGE'];
}
```

Source:
```
public function select(string $table, array $fields, array $where = [], array $options = []): object
```

## Update

```
$database->update('tablename', [
    'AGE' => 21
], [
    'AGE' => 20,
    'ID' => 1
]);
```

Source:
```
public function update(string $table, array $fields, array $where = [], array $options = []): bool
```

## Delete

```
$database->delete('tablename', [
    'ID' => 1
]);
```

Source:
```
public function delete(string $table, array $where = [], array $options = []): bool
```

## Options

You can pass additional options in the `$options` array.

```
[
    'limit' => 10, // int
    'offset' => 20, // int
    'order' => 'DESC', // string (ASC|DESC)
    'orderby' => 'AGE' // string (multiple fields seperated with a ",")
]
```