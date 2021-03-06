CREATE TABLE m_user (id BIGINT AUTO_INCREMENT, sf_guard_user_id BIGINT UNIQUE, user_name VARCHAR(255) NOT NULL UNIQUE, email VARCHAR(255), profile TEXT, birthday DATE, is_private TINYINT(1) DEFAULT '0' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX sf_guard_user_id_idx (sf_guard_user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE t_favorite (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, tweet_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX tweet_id_idx (tweet_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE t_follow (user_id BIGINT, follow_user_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, follow_user_id)) ENGINE = INNODB;
CREATE TABLE t_retweet (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, tweet_id BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), INDEX tweet_id_idx (tweet_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE t_tweet (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, body VARCHAR(140) NOT NULL, is_enable TINYINT(1) DEFAULT '1' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE t_user_profile
(
  id           BIGINT AUTO_INCREMENT,
  user_id      BIGINT                 NOT NULL,
  display_name VARCHAR(255)           NOT NULL UNIQUE,
  profile      TEXT,
  birthday     DATE,
  is_private   TINYINT(1) DEFAULT '0' NOT NULL,
  created_at   DATETIME               NOT NULL,
  updated_at   DATETIME               NOT NULL,
  INDEX user_id_idx (user_id),
  PRIMARY KEY (id)
) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE m_user ADD CONSTRAINT m_user_sf_guard_user_id_sf_guard_user_id FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE t_favorite
  ADD CONSTRAINT t_favorite_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user (id) ON DELETE CASCADE;
ALTER TABLE t_favorite ADD CONSTRAINT t_favorite_tweet_id_t_tweet_id FOREIGN KEY (tweet_id) REFERENCES t_tweet(id) ON DELETE CASCADE;
ALTER TABLE t_follow
  ADD CONSTRAINT t_follow_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user (id) ON DELETE CASCADE;
ALTER TABLE t_retweet
  ADD CONSTRAINT t_retweet_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user (id) ON DELETE CASCADE;
ALTER TABLE t_retweet ADD CONSTRAINT t_retweet_tweet_id_t_tweet_id FOREIGN KEY (tweet_id) REFERENCES t_tweet(id) ON DELETE CASCADE;
ALTER TABLE t_tweet
  ADD CONSTRAINT t_tweet_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user (id) ON DELETE CASCADE;
ALTER TABLE t_user_profile
  ADD CONSTRAINT t_user_profile_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user (id) ON DELETE CASCADE;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
