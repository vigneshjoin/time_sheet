WITH RECURSIVE ledger_hierarchy AS (
    -- Base Case: Select root accounts (parent_id = 0)
    SELECT 
        id, 
        parent_id, 
        account_code, 
        CAST(account_code AS CHAR(255)) AS full_path
    FROM 
        general_ledgers
    WHERE 
        parent_id = 0

    UNION ALL

    -- Recursive Case: Select child accounts and build hierarchy
    SELECT 
        gl.id,
        gl.parent_id,
        gl.account_code,
        CONCAT(lh.full_path, ' -> ', gl.account_code) AS full_path
    FROM 
        general_ledgers gl
    INNER JOIN 
        ledger_hierarchy lh ON gl.parent_id = lh.account_code  -- Ensuring correct hierarchy
)

-- Final Selection Ordered by Hierarchy
SELECT 
    *
FROM 
    ledger_hierarchy
ORDER BY 
    full_path;
    
    SELECT * FROM general_ledgers;
