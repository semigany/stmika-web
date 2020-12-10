-- Add specialty column to users table
ALTER TABLE users
    ADD COLUMN specialty varchar(80);

create or replace VIEW `users_view`  AS  select `u`.`id` AS `id`,`u`.`identifiant` AS `identifiant`,
`u`.`first_name` AS `first_name`,`u`.`last_name` AS `last_name`,`u`.`email` AS `email`,
`u`.`phone_number` AS `phone_number`,`u`.`adress` AS `adress`,`u`.`birth_date` AS `birth_date`,
`u`.`start_year` AS `start_year`,`u`.`end_year` AS `end_year`,`u`.`photo` AS `photo`,
`u`.`password` AS `password`,`u`.`promotion_id` AS `promotion_id`,`u`.`student` AS `student`,
`u`.`school_name` AS `school_name`,`u`.`faculty_id` AS `faculty_id`,`u`.`level` AS `level`, `u`.`specialty` AS `specialty`,
`u`.`employee` AS `employee`,`u`.`job_title` AS `job_title`,`u`.`organization_name` AS `organization_name`,
`u`.`organization_adress` AS `organization_adress`,`u`.`active` AS `active`,`u`.`request_date` AS `request_date`,
`u`.`validation_date` AS `validation_date`,`u`.`validation_note` AS `validation_note`,
`u`.`domain_id` AS `domain_id`,`p`.`name` AS `promotion`,`p`.`release_year` AS `release_year`
from (`users` `u` left join `promotions` `p` on((`u`.`promotion_id` = `p`.`id`))) ;