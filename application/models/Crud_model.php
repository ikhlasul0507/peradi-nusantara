<?php
class Crud_model extends CI_Model {

    public function get_all($table) {
        return $this->db->get($table)->result_array();
    }

    public function get_by_id($table, $id, $id_field) {
        return $this->db->get_where($table, array($id_field => $id))->row_array();
    }

    public function insert($table, $data) {
        return $this->db->insert($table, $data);
    }

    public function update($table, $id, $data, $id_field) {
        $this->db->where($id_field, $id);
        return $this->db->update($table, $data);
    }

    public function delete($table, $id, $id_field) {
        $this->db->where($id_field, $id);
        return $this->db->delete($table);
    }

    public function record_count($table) {
        return $this->db->count_all($table);
    }

    public function fetch_records($table, $limit, $start) {
        $this->db->limit($limit, $start);
        $query = $this->db->get($table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
}
