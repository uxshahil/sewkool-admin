
# select all parent status
SELECT * FROM sewkool_db.Status WHERE fk_table = 'Job_Card' AND fk_field = 'job_card_status_id' AND  parent_id IS NULL;

# select all sub status by parent_id
SELECT * FROM sewkool_db.Status WHERE fk_table = 'Job_Card' AND fk_field = 'job_card_status_id' AND parent_id = 1;

# select all sub_status by (parent) title
SELECT child.id, child.title FROM sewkool_db.Status child
LEFT JOIN sewkool_db.Status parent
ON parent.id = child.parent_id
WHERE parent.fk_table = 'Job_Card' AND parent.fk_field = 'job_card_status_id' AND parent.title = 'Payment';