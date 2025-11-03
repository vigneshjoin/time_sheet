#TRUNCATE general_ledgers;

SELECT * FROM general_ledgers ;
#
#SELECT account_code,LENGTH(account_code) FROM general_ledgers ORDER BY LENGTH(account_code), account_code;

SELECT account_code 
FROM general_ledgers 
ORDER BY 
    LENGTH(account_code),  -- Order by length first (shorter codes first)
    account_code;          -- Then order numerically


