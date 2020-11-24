<?php
    class PwdResetLink_model extends CI_Model {
        public function isValidToken($token) {
            $sql = 'SELECT * FROM pwd_reset_links WHERE token = ?';
            $query = $this->db->query($sql, array($token));
            if ($query->result()) {
                if ($query->result()[0]->expire_at > new DateTime("now")) {
                    throw new Exception('Lien expiré');
                }
                return true;
            } else {
                throw new Exception('Lien non valide');
            }
        }

        public function getUserByToken($token) {
            $sql = 'SELECT * FROM pwd_reset_links WHERE token = ?';
            $query = $this->db->query($sql, array($token));
            if ($query->result()) {
                $email = $query->result()[0]->email;
                
                $this->db->where('email', $email);
                $queryUser = $this->db->get('users');
                return $queryUser->result()[0];
            }
        }
    }
?>