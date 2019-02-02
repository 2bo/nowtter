CREATE TABLE m_user (id BIGINT AUTO_INCREMENT, user_name VARCHAR(255) NOT NULL UNIQUE, email VARCHAR(255), profile TEXT, birthday DATE, is_private TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE m__user (id BIGINT AUTO_INCREMENT, user_name VARCHAR(255) NOT NULL UNIQUE, email VARCHAR(255), profile TEXT, birthday DATE, is_private TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE t_favorite (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, tweet_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX tweet_id_idx (tweet_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE t_follow (user_id BIGINT, follow_user_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, follow_user_id)) ENGINE = INNODB;
CREATE TABLE t_retweet (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, tweet_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX tweet_id_idx (tweet_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE t_tweet (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, body VARCHAR(140), is_enable TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE t__favorite (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, tweet_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX tweet_id_idx (tweet_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE t__follow (user_id BIGINT, follow_user_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, follow_user_id)) ENGINE = INNODB;
CREATE TABLE t__retweet (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, tweet_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX tweet_id_idx (tweet_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE t__tweet (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, body VARCHAR(140), is_enable TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE t_favorite ADD CONSTRAINT t_favorite_user_id_m_user_id FOREIGN KEY (user_id) REFERENCES m_user(id) ON DELETE CASCADE;
ALTER TABLE t_favorite ADD CONSTRAINT t_favorite_tweet_id_t_tweet_id FOREIGN KEY (tweet_id) REFERENCES t_tweet(id) ON DELETE CASCADE;
ALTER TABLE t_follow ADD CONSTRAINT t_follow_user_id_m_user_id FOREIGN KEY (user_id) REFERENCES m_user(id) ON DELETE CASCADE;
ALTER TABLE t_retweet ADD CONSTRAINT t_retweet_user_id_m_user_id FOREIGN KEY (user_id) REFERENCES m_user(id) ON DELETE CASCADE;
ALTER TABLE t_retweet ADD CONSTRAINT t_retweet_tweet_id_t_tweet_id FOREIGN KEY (tweet_id) REFERENCES t_tweet(id) ON DELETE CASCADE;
ALTER TABLE t_tweet ADD CONSTRAINT t_tweet_user_id_m_user_id FOREIGN KEY (user_id) REFERENCES m_user(id) ON DELETE CASCADE;
ALTER TABLE t__favorite ADD CONSTRAINT t__favorite_user_id_m__user_id FOREIGN KEY (user_id) REFERENCES m__user(id) ON DELETE CASCADE;
ALTER TABLE t__favorite ADD CONSTRAINT t__favorite_tweet_id_t__tweet_id FOREIGN KEY (tweet_id) REFERENCES t__tweet(id) ON DELETE CASCADE;
ALTER TABLE t__follow ADD CONSTRAINT t__follow_user_id_m__user_id FOREIGN KEY (user_id) REFERENCES m__user(id) ON DELETE CASCADE;
ALTER TABLE t__retweet ADD CONSTRAINT t__retweet_user_id_m__user_id FOREIGN KEY (user_id) REFERENCES m__user(id) ON DELETE CASCADE;
ALTER TABLE t__retweet ADD CONSTRAINT t__retweet_tweet_id_t__tweet_id FOREIGN KEY (tweet_id) REFERENCES t__tweet(id) ON DELETE CASCADE;
ALTER TABLE t__tweet ADD CONSTRAINT t__tweet_user_id_m__user_id FOREIGN KEY (user_id) REFERENCES m__user(id) ON DELETE CASCADE;