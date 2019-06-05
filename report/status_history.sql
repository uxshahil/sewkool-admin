-- History of job_card_status for a job_card
SELECT 
    sh.fk_field, sh.title, i.invoice_number, i.job_card_id, u.first_name, u.last_name, sh.created_date 
FROM 
    Status_History sh 
LEFT JOIN 
    Invoice i 
ON 
    sh.fk_field_pk = i.job_card_id
LEFT JOIN 
    User u
ON 
    sh.created_by = u.id
WHERE 
    sh.fk_field = 'job_card_status_id'
AND 
    i.job_card_id = ?;

-- History of invoice_status for a job_card
SELECT 
    sh.fk_field, sh.title, i.invoice_number, i.job_card_id, u.first_name, u.last_name, sh.created_date 
FROM 
    Status_History sh 
LEFT JOIN 
    Invoice i 
ON 
    sh.fk_field_pk = i.id
LEFT JOIN 
    User u
ON 
    sh.created_by = u.id
WHERE 
    sh.fk_field = 'invoice_status_id'
AND 
    i.job_card_id = ?;
