SELECT u.name, COUNT(P.id) FROM test_users u
  JOIN test_phone_numbers p ON p.user_id = u.id
WHERE  u.gender = 2 AND TIMESTAMPDIFF(YEAR, FROM_UNIXTIME(U.birth_date), NOW()) BETWEEN 18 AND 22
GROUP BY p.user_id;

ALTER TABLE test_users ADD INDEX `bd` (`birth_date`);
ALTER TABLE test_phone_numbers ADD INDEX `uid` (`user_id`);
