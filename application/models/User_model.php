<?php
    class User_model extends CI_Model {
        public $identifiant;
        public $first_name;
        public $last_name;
        public $email;
        public $phone_number;
        public $birth_date;
        public $adress;
        public $start_year;
        public $end_year;
        public $photo;
        public $password;
        public $promotion_id;
        // is student
        public $student;
        public $school_name;
        public $faculty_id;
        public $level;
        // is employee
        public $employee;
        public $job_title;
        public $organization_name;
        public $organization_adress;
        public $active;
        public $request_date;
        public $validation_date;
        public $validation_note;

        public function insert_entry($attributes) {
            $this->identifiant =                        $attributes->identifiant;
            $this->first_name =                         $attributes->first_name;
            $this->last_name =                      $attributes->last_name;
            $this->email =                      $attributes->email;
            $this->phone_number =                       $attributes->phone_number;
            $this->birth_date =                         $attributes->birth_date;
            $this->adress =                         $attributes->adress;
            $this->start_year =                         $attributes->start_year;
            $this->end_year =                       $attributes->end_year;
            $this->photo =                      $attributes->photo;
            $this->password =                       $attributes->password;
            $this->promotion_id =                       $attributes->promotion_id;
            $this->student =                        $attributes->student;
            $this->school_name =                        $attributes->school_name;
            $this->faculty_id =                         $attributes->faculty_id;
            $this->level =                      $attributes->level;
            $this->employee =                      $attributes->employee;
            $this->job_title =                      $attributes->job_title;
            $this->domain_id =                      $attributes->domain_id;
            $this->organization_name =                        $attributes->organization_name;
            $this->organization_adress =                        $attributes->organization_adress;
            $this->active =                        $attributes->active;
            $this->request_date = $attributes->request_date;
            $this->validation_date = $attributes->validation_date;
            $this->validation_note = $attributes->validation_note;


            $this->db->insert('users', $this);
        }

        public function getByIdentification($email, $password) {
            $sql = 'SELECT * FROM users WHERE email = ?';
            $query = $this->db->query($sql, array($email));
            if ($query->result()) {
                if ($query->result()[0]->active) {
                    $user = $query->result()[0];
                    if (password_verify($password, $user->password)) {
                        return $user;
                    }
                    throw new Exception("Email ou mot de passe incorrect");
                } else {
                    throw new Exception("Ce compte n'a pas encore été activé. Veuillez contacter l'Administrateur du site");
                }
            } else {
                throw new Exception('Email ou mot de passe incorrect');
            }
        }

        public function getNbActive($search = "",
                                    $promotion_id = 0,
                                    $domain_id = 0,
                                    $start_year = 0,
                                    $end_year = 0)  {
            $this->db->where('active', 1);
            if (!empty($search)) {
                $this->db->like('first_name', trim($search, " "));
                $this->db->or_like('last_name', trim($search, " "));
            }

            if ($promotion_id != 0) {
                $this->db->where('promotion_id', $promotion_id);
            }

            if ($domain_id != 0) {
                $this->db->where('domain_id', $domain_id);
            }

            if ($start_year != 0 && $end_year != 0) {
                $start_year_sql = '(start_year between ' . $start_year . ' and ' . $end_year. ') or (end_year between ' . $start_year . ' and ' . $end_year. ')';
                $this->db->where($start_year_sql);
            } else if ($start_year != 0 && $end_year == 0) {
                $this->db->where('start_year', $start_year);
            } else if ($start_year == 0 && $end_year != 0) {
                $this->db->where('end_year', $end_year);
            } else {

            }
            return $this->db->count_all_results('users');
        }

        public function get_current_page_records($limit,
                                                $start,
                                                $search = "",
                                                $promotion_id = 0,
                                                $domain_id = 0,
                                                $faculty_id = 0,
                                                $start_year = 0,
                                                $end_year = 0)
        {
            $this->db->limit($limit, $start);
            $this->db->where('active', 1);

            if (!empty($search)) {
                $this->db->like('first_name', trim($search, " "));
                $this->db->or_like('last_name', trim($search, " "));
                $this->db->where('active', 1);
            }

            if ($promotion_id != 0) {
                $this->db->where('promotion_id', $promotion_id);
            }

            if ($domain_id != 0) {
                $this->db->where('domain_id', $domain_id);
            }

            if ($faculty_id != 0) {
                $this->db->where('faculty_id', $faculty_id);
            }

            if ($start_year != 0 && $end_year != 0) {
                $start_year_sql = '(start_year between ' . $start_year . ' and ' . $end_year. ') or (end_year between ' . $start_year . ' and ' . $end_year. ')';
                $this->db->where($start_year_sql);
            } else if ($start_year != 0 && $end_year == 0) {
                $this->db->where('start_year', $start_year);
            } else if ($start_year == 0 && $end_year != 0) {
                $this->db->where('end_year', $end_year);
            } else {

            }

            $query = $this->db->get("users_view");
            // print_r($this->db->last_query());

            if ($query->num_rows() > 0)
            {
                foreach ($query->result() as $row)
                {
                    $data[] = $row;
                }

                return (object) array(
                    'rows' => $this->getNbActive(
                        $search, $promotion_id, $domain_id, $start_year, $end_year
                    ),
                    'users' => $data
                );
            }

            return (object) array(
                'rows' => 0,
                'users' => []
            );
        }

        public function getById($id) {
          $this->db->where('id', $id);
          $query = $this->db->get('users_view');
          return $query->row();
        }

        public function getByPromotion($promotion_id) {
          $this->db->where('promotion_id', $promotion_id);
          $this->db->where('active', 1);
          $query = $this->db->get('users_view');
          return $query->result();
        }

        private function queryNewUsers($search = "") {
            $this->db->where('active', false);
            $this->db->where('validation_date', null);

            if (!empty($search)) {
                $this->db->like('first_name', trim($search, " "));
                $this->db->or_like('last_name', trim($search, " "));
            }
        }

        public function getTotalNewRegistrationRequests($search = "") {
            $this->queryNewUsers($search);
            return $this->db->count_all_results('users');
        }

        public function getNewUserRequests($search = "", $limit, $start) {
            $this->queryNewUsers($search);
            $this->db->limit($limit, $start);
            $query = $this->db->get('users_view');
            return $query->result();
        }

        public function rejectRegistration($id, $message) {
            $user = $this->getById($id);

            $this->load->library('email', NULL, 'email_lib');

            $this->email_lib->from('support@semigany.org', 'Support semigany.org');
            $this->email_lib->to($user->email);

            $link = base_url('user/registration');

            $mailContent = <<<EOD
            Bonjour $user->last_name, \n
            (ATTENTION : TEXTE A REDIGER)
            Après étude des informations que vous nous avez fourni, ... (excuse blablabla).\n
            RAISON PRINCIPALE: $message
            Ainsi, nous ne gardons pas vos informations. Nous procédons à la suppression.\n
            S'inscrire à nouveau : $link \n
            Support semigany.org
            EOD;

            $this->email_lib->subject("Refus de l'inscription à semigany.org activé");
            $this->email_lib->message($mailContent);

            $this->email_lib->send();

            $this->db->where('id', $id);
            $this->db->delete('users');
        }

        public function acceptRegistration($id) {
            $this->db->set('validation_note', 'ok');
            $this->db->set('validation_date', date('Y-m-d'));
            $this->db->set('active', true);
            $this->db->where('id', $id);
            $this->db->update('users');

            $user = $this->getById($id);

            $this->load->library('email', NULL, 'email_lib');

            $this->email_lib->from('support@semigany.org', 'Support semigany.org');
            $this->email_lib->to($user->email);

            $link = base_url('user/signInForm');

            $mailContent = <<<EOD
            Bonjour $user->last_name, \n
            Votre compte a été validé et activé par les responsables de semigany.org.\n
            Vous pouvez vous connecter à présent.\n
            Se connecter : $link \n
            Support semigany.org
            EOD;

            $this->email_lib->subject('Compte semigany.org activé');
            $this->email_lib->message($mailContent);

            $this->email_lib->send();
        }

        public function administratorCredentials($username, $password) {
            $sql = 'SELECT * FROM administrators WHERE username = ? AND password = ?';
            $query = $this->db->query($sql, array($username, $password));
            if ($query->result()) {
                return $query->result()[0];
            } else {
                throw new Exception('Email ou mot de passe incorrect');
            }
        }

        public function sendForgotPwdRequest($email) {
            $sql = 'SELECT * FROM users WHERE email = ?';
            $query = $this->db->query($sql, array($email));
            if ($query->result()) {
                if ($query->result()[0]->active) {
                    $user = $query->result()[0];
                    $now = new DateTime("now");
                    $token = password_hash($now->format('Y-m-d H:i:s'), PASSWORD_DEFAULT);
                    $this->db->insert('pwd_reset_links', (object)[
                        'email' => $email,
                        'created_at' => $now,
                        'expired_at' => $now->modify('+1 day'),
                        'token' => $token
                    ]);

                    return $token;
                } else {
                    throw new Exception("Ce compte n'a pas encore été activé. Veuillez contacter l'Administrateur du site");
                }
            } else {
                throw new Exception('Cette adresse email est incorrecte');
            }
        }

        public function getByEmail($email) {
            $this->db->where('email', $email);
            $query = $this->db->get('users');
            return $query->row()[0];
        }

        public function updatePassword($newPassword, $resetToken) {
            $sql = 'SELECT * FROM pwd_reset_links WHERE token = ?';
            $tokenQuery = $this->db->query($sql, array($resetToken));
            $email = $tokenQuery->result()[0]->email;

            $this->db->set('password', password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]));
            $this->db->where('email', $email);
            $this->db->update('users');
        }
    }
?>