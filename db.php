<?php 

/**
 * The function that connects us to the MySQL Database
 * This uses prepared statements and other layers
 * of security so this is a much better way.
 * Also, this uses OOP so the methods to get
 * the data is SO MUCHH easier than memorizing kadtung
 * mysqli_fetch_assoc or unsa tong mga amawa to
 */
function connect(): PDO {
    // set as static, meaning ma-save sa cache
    // para dile magsige ug gama ug bag-ong connection
    // sa database, kani nalang ang kuhaon if ever makaset
    // na ug connection
    static $pdo = null;

    if ($pdo == null) {
        // User Credentials
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "jbas";

        $dsn = "mysql:host=$hostname;dbname=$database";
       
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // A config to make the fetching of the data in OOP way instead
        // of array like $row['colName'] becomes $row->colName which
        // is something I find more readable and tbh, contrasty
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    return $pdo;
}

/**
 * Just a lil function wrapper for the connection
 * to lessen the code
 * 
 * @var string $statement - The prepared statement or query
 *      Example: SELECT * FROM users WHERE id = ?
 * @var list $values - The values to supply the placeholders
 *      Example: 1 // So kuhaon ang user nga naay id nga 1
 */
function execute(string $statement, array $values=[]): bool|PDOStatement {
    $pdo = connect();
    $stmt = $pdo->prepare($statement);
    $stmt->execute($values);
    return $stmt;
}