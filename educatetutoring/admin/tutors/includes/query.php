<?php

//Academic: Student Learning Plan & Evaluations
SELECT academic_slpes.slpe_id
     , academic_slpes.year
     , academic_slpes.term
     , academic_slpes.lesson
     , academic_slpes.date
     , academic_slpes.tutor_evaluation
     , academic_slpes.student_self_assessment
     , academic_slpes.comments_homework
     , CONCAT(admin_students.student_firstname, ' ', admin_students.student_lastname) AS student
     , CONCAT(admin_users.user_firstname, ' ', admin_users.user_lastname) AS tutor
     , library_subjects.subject
     , library_concepts.concept
     , library_concept_details.concept_detail
     , library_learning_activities.learning_activity
FROM academic_slpes 
JOIN admin_students ON academic_slpes.student_id = admin_students.student_id
JOIN admin_users ON academic_slpes.tutor_id = admin_users.user_id
JOIN library_subjects ON academic_slpes.subject_id = library_subjects.subject_id 
JOIN library_concepts ON academic_slpes.concept_id = library_concepts.concept_id 
JOIN library_concept_details ON academic_slpes.concept_detail_id = library_concept_details.concept_detail_id
JOIN library_learning_activities ON academic_slpes.learning_activity_id = library_learning_activities.learning_activity_id

//Admin: Students
SELECT student_id, CONCAT(student_firstname, ' ', student_lastname) AS student FROM admin_students







?>