#SELECT * from general_ledgers;
#SELECT * from walk_in_customer_master;
#SELECT * from currencies;

#SELECT * from users;


/**
SELECT 
    a1.id AS account_id, 
    a1.account_code, 
    a2.title AS parent_title,
    a1.category, 
    a1.classification
    
FROM stage.general_ledgers a1
LEFT JOIN stage.general_ledgers a2 ON a1.parent_id = a2.id
ORDER BY a1.parent_id ASC, a1.id ASC;
**/

WITH RECURSIVE ledger_hierarchy AS (
    SELECT 
        id AS account_id, 
        account_code, 
        title AS parent_title,
        category, 
        classification,
        parent_id,
        1 AS level
    FROM stage.general_ledgers
    WHERE parent_id IS NULL

    UNION ALL

    SELECT 
        a1.id AS account_id, 
        a1.account_code, 
        lh.parent_title,
        a1.category, 
        a1.classification,
        a1.parent_id,
        lh.level + 1 AS level
    FROM stage.general_ledgers a1
    INNER JOIN ledger_hierarchy lh ON a1.parent_id = lh.account_id
)
SELECT 
    account_id, 
    account_code, 
    parent_title,
    category, 
    classification,
    parent_id,
    level
FROM ledger_hierarchy
ORDER BY parent_id ASC, account_id ASC;