WITH RECURSIVE account_hierarchy AS (
    SELECT 
        id,
        parent_id,
        account_code,
        category,
        classification,
        type,
        account,
        sub_class,
        title,
        persian_title,
        full_name,
        cb_group,
        defaultfcy,
        comment,
        status,
        1 AS level
    FROM 
        general_ledgers
    WHERE 
        parent_id IS NULL
    UNION ALL
    SELECT 
        a.id,
        a.parent_id,
        a.account_code,
        a.category,
        a.classification,
        a.type,
        a.account,
        a.sub_class,
        a.title,
        a.persian_title,
        a.full_name,
        a.cb_group,
        a.defaultfcy,
        a.comment,
        a.status,
        ah.level + 1
    FROM 
        general_ledgers a
    INNER JOIN 
        account_hierarchy ah ON ah.id = a.parent_id
)
SELECT 
    *
FROM 
    account_hierarchy
ORDER BY 
    level, account_code;