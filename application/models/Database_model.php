<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Database_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->dbutil(); // Load the database utility class
        $this->load->dbforge(); // Load the database forge class
    }

    public function duplicate_database($original_db, $new_db) {
        // Connect to the original database
        $this->db->db_select($original_db);

        // Create the new database
        if (!$this->dbforge->create_database($new_db)) {
            return "Error creating new database: $new_db";
        }

        // Retrieve the list of tables from the original database
        $tables = $this->db->list_tables($original_db);
        // Switch to the new database
        $this->db->db_select($new_db);


        foreach ($tables as $table) {
        // Get CREATE TABLE query for the current table
        $query = $this->db->query("SHOW CREATE TABLE $original_db.$table");
        $create_table_sql = $query->row_array()['Create Table'];

        // Debug: Output the table creation SQL
        echo "<pre>Creating table: " . $create_table_sql . "</pre>";

        // Create the table in the new database
        if (!$this->db->query($create_table_sql)) {
            return "Error creating table $table in new database.";
        }

        // Debug: Check if the table creation was successful
        if ($this->db->table_exists($table)) {
            echo "<pre>Table $table created successfully.</pre>";
        }

        // Insert data from the original table into the new table
        $insert_query = "INSERT INTO $new_db.$table SELECT * FROM $original_db.$table";
        
        // Debug: Output the insert SQL
        echo "<pre>Insert query: " . $insert_query . "</pre>";

        if (!$this->db->query($insert_query)) {
            return "Error inserting data into $new_db.$table.";
        }

        echo "<pre>Data inserted successfully into $new_db.$table.</pre>";
    }

        return "Database duplication completed successfully!";
    }
}
