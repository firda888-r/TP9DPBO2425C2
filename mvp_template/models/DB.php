<?php

class DB{

    private $host = "localhost";
    private $db_name = "";
    private $username = "";
    private $password = "";

    protected $conn; // Diubah menjadi protected agar bisa diakses di TabelPembalap jika diperlukan
    protected $result; // Diubah menjadi protected

    // Constructor untuk inisialisasi database
    function __construct($host, $db_name, $username, $password) {
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;
        $this->conn = $this->connect();
    }

    // Method untuk membuat koneksi database
    public function connect() {

       $conn = null;

        try {
        $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4"; $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $conn = new PDO($dsn, $this->username, $this->password, $options);
    } catch (PDOException $exception) 
    {
        die("Koneksi gagal: " . $exception->getMessage()); 
    }
    return $conn;
    }

    // Method untuk mengeksekusi query SELECT (sudah ada)
    public function executeQuery($query, $params = []) {

        if ($this->conn === null) {
        throw new RuntimeException('No database connection. Make sure connect() succeeded.');
        }

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            $this->result = $stmt;
            return $stmt;
        } catch (PDOException $e) {
        throw new RuntimeException('Query gagal: ' . $e->getMessage(), 0, $e);
        }
    }

    // ====================================================================
    // PERBAIKAN: Menambahkan executeAffectedQuery (Untuk INSERT/UPDATE/DELETE)
    // ====================================================================
    /**
     * Mengeksekusi query yang memengaruhi baris (INSERT, UPDATE, DELETE).
     * @param string $query Query SQL yang akan dieksekusi.
     * @param array $params Parameter untuk prepared statement.
     * @return int Jumlah baris yang terpengaruh.
     */
    public function executeAffectedQuery(string $query, array $params = []): int
    {
        if ($this->conn === null) {
throw new RuntimeException('No database connection. Make sure connect() succeeded.');
}

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            
            // Mengembalikan jumlah baris yang terpengaruh (rowCount)
            return $stmt->rowCount(); 
            
        } catch (PDOException $e) {
            throw new RuntimeException('Query affected rows gagal: ' . $e->getMessage(), 0, $e);
        }
    }

// Mengambil semua hasil dari query sebagai array asosiatif (sudah ada)
    public function getAllResult() {
        if ($this->result === null) {
           return [];
        }
    return $this->result->fetchAll(PDO::FETCH_ASSOC);
    }

    // ====================================================================
    // TAMBAHAN: getSingleResult (Untuk mengambil 1 baris, misal Edit)
    // ====================================================================
    public function getSingleResult() {
        if ($this->result === null) {
            return null;
        }
        return $this->result->fetch(PDO::FETCH_ASSOC);
    }

// Method untuk menutup koneksi database
    public function close() {
      $this->conn = null;
    }

}

?>