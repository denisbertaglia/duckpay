INSERT INTO users (id, user_type,name,password,created_at,updated_at )
VALUES (1, 1,  'Joâo Henrique','$2y$10$lkvS3jcgZN5GQl9y43Gh8e8LZTB4thd9arHQgrp7YcxlgHsWL1zK2', '2023-08-15 21:30:05', '2023-08-15 21:30:05' );
INSERT INTO users (id,user_type,name,password,created_at,updated_at )
VALUES (2, 2,  'Thiago Anton','$2y$10$2tY7oivAJXRHwMJlbVMFfOxhDfQJOW1o0/Z8t9C3MZp0znKcmIKsS', '2023-08-15 21:30:05', '2023-08-15 21:30:05' );

INSERT INTO customers (id,user_id,cpf,balance,created_at,updated_at )
VALUES (1, 1,'434.234.778-98','49444', '2023-08-15 21:30:05', '2023-08-15 21:30:05' );
INSERT INTO shopkeepers (id,user_id,cnpj,balance,created_at,updated_at )
VALUES (1, 2,'95.454.908/0001-81','49444', '2023-08-15 21:30:05', '2023-08-15 21:30:05' );

