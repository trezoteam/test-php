SELECT 
qz.`name`,
q.`subject`,
IF(pa.`answer` IS NULL,qo.`answer`,pa.`answer`) AS resposta,
qo.`is_correct`
FROM `participant_answer` pa
INNER JOIN `question` q ON pa.`question_id` = q.`id`
INNER JOIN `quiz` qz ON qz.`id` = q.`quiz_id`
LEFT JOIN `question_option` qo ON qo.`id` = pa.`question_option_id`
