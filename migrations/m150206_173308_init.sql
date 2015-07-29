-- MySQL Script generated by MySQL Workbench
-- 05/19/15 11:24:26
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema kidup
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema kidup
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `kidup` DEFAULT CHARACTER SET latin1 ;
USE `kidup` ;

-- -----------------------------------------------------
-- Table `kidup`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `type` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`user` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(60) NOT NULL,
  `auth_key` VARCHAR(32) NOT NULL,
  `confirmed_at` INT(11) NULL,
  `unconfirmed_email` VARCHAR(255) NULL DEFAULT NULL,
  `blocked_at` INT(11) NULL DEFAULT NULL,
  `registration_ip` VARCHAR(45) NULL DEFAULT NULL,
  `flags` INT(11) NOT NULL DEFAULT '0',
  `status` INT(11) NOT NULL,
  `role` INT(11) NOT NULL,
  `created_at` INT(11) NOT NULL,
  `updated_at` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`currency`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`currency` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  `abbr` VARCHAR(5) NOT NULL,
  `forex_name` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`language`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`language` (
  `language_id` VARCHAR(5) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `language` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `name` VARCHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `name_ascii` VARCHAR(32) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `status` VARCHAR(128) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `country` VARCHAR(3) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  PRIMARY KEY (`language_id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `kidup`.`country`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`country` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL DEFAULT '',
  `code` VARCHAR(2) NOT NULL DEFAULT '',
  `main_language_id` VARCHAR(5) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `currency_id` INT(11) NOT NULL,
  `phone_prefix` INT(11) NOT NULL,
  `vat` DOUBLE NULL,
  PRIMARY KEY (`id`),
  INDEX `FK_country_currency` (`currency_id` ASC),
  INDEX `fk_country_language1_idx` (`main_language_id` ASC),
  CONSTRAINT `FK_country_currency`
    FOREIGN KEY (`currency_id`)
    REFERENCES `kidup`.`currency` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_country_language1`
    FOREIGN KEY (`main_language_id`)
    REFERENCES `kidup`.`language` (`language_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`location`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`location` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `type` INT(2) NOT NULL DEFAULT '0',
  `country` INT(11) NULL DEFAULT NULL,
  `city` VARCHAR(100) NULL DEFAULT NULL,
  `zip_code` VARCHAR(50) NULL DEFAULT NULL,
  `street_name` VARCHAR(256) NULL DEFAULT NULL,
  `street_number` VARCHAR(10) NULL DEFAULT NULL,
  `longitude` FLOAT NOT NULL,
  `latitude` FLOAT NOT NULL,
  `user_id` INT(11) NOT NULL,
  `created_at` INT(11) NOT NULL,
  `updated_at` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `latlong` (`longitude` ASC, `latitude` ASC),
  INDEX `fk_location_user1_idx` (`user_id` ASC),
  INDEX `FK_location_country` (`country` ASC),
  CONSTRAINT `FK_location_country`
    FOREIGN KEY (`country`)
    REFERENCES `kidup`.`country` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_location_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `kidup`.`item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`item` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(140) NULL DEFAULT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `price_day` INT NULL,
  `price_week` INT NULL DEFAULT NULL,
  `price_month` INT NULL DEFAULT NULL,
  `owner_id` INT(11) NULL DEFAULT NULL,
  `condition` INT(11) NULL DEFAULT NULL,
  `currency_id` INT(11) NULL DEFAULT NULL,
  `is_available` TINYINT(1) NULL DEFAULT 0,
  `location_id` INT(11) NULL DEFAULT NULL,
  `created_at` INT(11) NOT NULL,
  `updated_at` INT(11) NOT NULL,
  `min_renting_days` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_item_user_idx` (`owner_id` ASC),
  INDEX `fk_item_currency1_idx` (`currency_id` ASC),
  INDEX `fk_item_location1_idx` (`location_id` ASC),
  INDEX `owner` (`owner_id` ASC),
  CONSTRAINT `fk_item_location1`
    FOREIGN KEY (`location_id`)
    REFERENCES `kidup`.`location` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE ,
  CONSTRAINT `fk_item_currency1`
    FOREIGN KEY (`currency_id`)
    REFERENCES `kidup`.`currency` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_item_user`
    FOREIGN KEY (`owner_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`payin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`payin` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `data` TEXT NULL,
  `type` VARCHAR(25) NULL,
  `user_id` INT(11) NOT NULL,
  `status` VARCHAR(45) NULL,
  `currency_id` INT(11) NOT NULL,
  `created_at` INT NULL,
  `updated_at` INT(11) NULL,
  `nonce` VARCHAR(1024) NULL,
  `braintree_backup` TEXT NULL,
  `service_fee` DOUBLE NULL,
  `service_fee_vat` DOUBLE NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_mango_pay_user1_idx` (`user_id` ASC),
  INDEX `fk_payin_currency1_idx` (`currency_id` ASC),
  CONSTRAINT `fk_mango_pay_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE ,
  CONSTRAINT `fk_payin_currency1`
    FOREIGN KEY (`currency_id`)
    REFERENCES `kidup`.`currency` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kidup`.`payout`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`payout` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `staus` VARCHAR(45) NOT NULL,
  `amount` DOUBLE NOT NULL,
  `currency_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `processed_at` INT NULL,
  `created_at` INT NOT NULL,
  `updated_at` INT NULL,
  `service_fee` DOUBLE NULL,
  `service_fee_vat` DOUBLE NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_payout_currency1_idx` (`currency_id` ASC),
  INDEX `fk_payout_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_payout_currency1`
    FOREIGN KEY (`currency_id`)
    REFERENCES `kidup`.`currency` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE ,
  CONSTRAINT `fk_payout_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kidup`.`booking`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`booking` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `status` VARCHAR(50) NOT NULL DEFAULT '0',
  `item_id` INT(11) NOT NULL,
  `renter_id` INT(11) NULL DEFAULT NULL,
  `currency_id` INT(11) NULL DEFAULT NULL,
  `amount_paid` DOUBLE NOT NULL,
  `refund_status` VARCHAR(20) NULL DEFAULT NULL,
  `time_from` INT(11) NOT NULL,
  `time_to` INT(11) NOT NULL,
  `item_backup` MEDIUMTEXT NULL DEFAULT NULL,
  `updated_at` INT(11) NOT NULL,
  `created_at` INT(11) NOT NULL,
  `payin_id` INT NULL,
  `payout_id` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_rent_item1_idx` (`item_id` ASC),
  INDEX `fk_rent_user1_idx` (`renter_id` ASC),
  INDEX `fk_rent_currency1_idx` (`currency_id` ASC),
  INDEX `fk_rent_payin1_idx` (`payin_id` ASC),
  INDEX `fk_rent_payout1_idx` (`payout_id` ASC),
  CONSTRAINT `fk_rent_currency1`
    FOREIGN KEY (`currency_id`)
    REFERENCES `kidup`.`currency` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_rent_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `kidup`.`item` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_rent_user1`
    FOREIGN KEY (`renter_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_rent_payin1`
    FOREIGN KEY (`payin_id`)
    REFERENCES `kidup`.`payin` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE ,
  CONSTRAINT `fk_rent_payout1`
    FOREIGN KEY (`payout_id`)
    REFERENCES `kidup`.`payout` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`conversation`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`conversation` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `initiater_user_id` INT(11) NOT NULL,
  `target_user_id` INT(11) NOT NULL,
  `title` VARCHAR(50) NOT NULL,
  `created_at` INT NOT NULL,
  `updated_at` INT NULL,
  `booking_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_conversation_user1_idx` (`initiater_user_id` ASC),
  INDEX `fk_conversation_user2_idx` (`target_user_id` ASC),
  CONSTRAINT `fk_conversation_user1`
    FOREIGN KEY (`initiater_user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_conversation_user2`
    FOREIGN KEY (`target_user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`item_has_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`item_has_category` (
  `item_id` INT(11) NOT NULL,
  `category_id` INT(11) NOT NULL,
  PRIMARY KEY (`item_id`, `category_id`),
  INDEX `fk_item_has_category_category1_idx` (`category_id` ASC),
  INDEX `fk_item_has_category_item1_idx` (`item_id` ASC),
  CONSTRAINT `fk_item_has_category_category1`
    FOREIGN KEY (`category_id`)
    REFERENCES `kidup`.`category` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_item_has_category_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `kidup`.`item` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`message` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `conversation_id` INT(11) NOT NULL,
  `message` TEXT NOT NULL,
  `sender_user_id` INT(11) NOT NULL,
  `read_by_receiver` TINYINT(1) NOT NULL DEFAULT '0',
  `receiver_user_id` INT(11) NULL DEFAULT NULL,
  `updated_at` INT(11) NOT NULL,
  `created_at` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_message_conversation1_idx` (`conversation_id` ASC),
  INDEX `FK_message_user` (`sender_user_id` ASC),
  INDEX `FK_message_user_2` (`receiver_user_id` ASC),
  CONSTRAINT `FK_message_user`
    FOREIGN KEY (`sender_user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_message_user_2`
    FOREIGN KEY (`receiver_user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_message_conversation1`
    FOREIGN KEY (`conversation_id`)
    REFERENCES `kidup`.`conversation` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`migration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`migration` (
  `version` VARCHAR(180) NOT NULL,
  `apply_time` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`version`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `kidup`.`profile`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`profile` (
  `user_id` INT(11) NOT NULL,
  `description` TEXT NULL DEFAULT NULL,
  `first_name` VARCHAR(128) NOT NULL,
  `last_name` VARCHAR(256) NOT NULL,
  `img` VARCHAR(256) NULL DEFAULT NULL,
  `phone_country` VARCHAR(5) NULL,
  `phone_number` VARCHAR(50) NULL DEFAULT NULL,
  `email_verified` TINYINT(1) NOT NULL DEFAULT '0',
  `phone_verified` TINYINT(1) NOT NULL DEFAULT '0',
  `identity_verified` TINYINT(1) NOT NULL DEFAULT '0',
  `location_verified` TINYINT(1) NOT NULL DEFAULT '0',
  `language` VARCHAR(6) NULL DEFAULT NULL,
  `currency_id` INT(11) NULL,
  `birthday` INT NULL DEFAULT NULL,
  `nationality` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  INDEX `fk_profile_currency1_idx` (`currency_id` ASC),
  INDEX `fk_user_profile_idx` (`user_id` ASC),
  INDEX `FK_profile_country` (`nationality` ASC),
  CONSTRAINT `FK_profile_country`
    FOREIGN KEY (`nationality`)
    REFERENCES `kidup`.`country` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `FK_profile_user`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_profile_currency1`
    FOREIGN KEY (`currency_id`)
    REFERENCES `kidup`.`currency` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`review`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`review` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `value` TEXT NULL,
  `reviewer_id` INT(11) NOT NULL,
  `reviewed_id` INT(11) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `rent_id` INT(11) NOT NULL,
  `item_id` INT(11) NULL DEFAULT NULL,
  `created_at` INT(11) NOT NULL,
  `updated_at` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_review_user1_idx` (`reviewer_id` ASC),
  INDEX `fk_review_item1_idx` (`item_id` ASC),
  INDEX `user_id` (`reviewed_id` ASC),
  INDEX `fk_review_rent1_idx` (`rent_id` ASC),
  CONSTRAINT `fk_review_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `kidup`.`item` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_review_user1`
    FOREIGN KEY (`reviewer_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_review_user2`
    FOREIGN KEY (`reviewed_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_review_rent1`
    FOREIGN KEY (`rent_id`)
    REFERENCES `kidup`.`booking` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`setting`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`setting` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `type` VARCHAR(50) NULL DEFAULT NULL,
  `value` VARCHAR(256) NULL DEFAULT NULL,
  `user_id` INT(11) NOT NULL,
  `created_at` INT NULL,
  `updated_at` INT NULL,
  PRIMARY KEY (`id`, `user_id`),
  INDEX `fk_setting_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_setting_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `kidup`.`social_account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`social_account` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `provider` VARCHAR(255) NOT NULL,
  `client_id` VARCHAR(255) NOT NULL,
  `data` TEXT NULL DEFAULT NULL,
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `account_unique` (`provider` ASC, `client_id` ASC),
  INDEX `fk_social_account_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_social_account_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`token`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`token` (
  `user_id` INT(11) NOT NULL,
  `code` VARCHAR(32) NOT NULL,
  `type` SMALLINT(6) NOT NULL,
  `created_at` INT(11) NOT NULL,
  INDEX `fk_user_token_idx` (`user_id` ASC),
  CONSTRAINT `fk_user_token`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `kidup`.`log`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tracking_id` VARCHAR(45) NULL,
  `user_id` INT(11) NULL,
  `action` VARCHAR(128) NOT NULL,
  `data` TEXT NOT NULL,
  `category` VARCHAR(45) NOT NULL,
  `created_at` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_log_user2_idx` (`user_id` ASC),
  CONSTRAINT `fk_log_user2`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kidup`.`media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`media` (
  `id` BIGINT NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `storage` VARCHAR(25) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `description` VARCHAR(256) NULL,
  `created_at` INT NOT NULL,
  `updated_at` INT NOT NULL,
  `file_name` VARCHAR(128) NOT NULL,
  INDEX `fk_media_user1_idx` (`user_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_media_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kidup`.`mail_message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`mail_message` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `message` TEXT NOT NULL,
  `from_email` VARCHAR(128) NOT NULL,
  `mail_account_id` INT NOT NULL,
  `message_id` INT(11) NOT NULL,
  `subject` VARCHAR(512) NULL,
  `created_at` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_mail_message_message1_idx` (`message_id` ASC),
  CONSTRAINT `fk_mail_message_message1`
    FOREIGN KEY (`message_id`)
    REFERENCES `kidup`.`message` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kidup`.`mail_account`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`mail_account` (
  `name` VARCHAR(128) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `conversation_id` INT(11) NOT NULL,
  `created_at` INT NULL,
  PRIMARY KEY (`name`),
  INDEX `fk_mail_account_user1_idx` (`user_id` ASC),
  INDEX `fk_mail_account_conversation1_idx` (`conversation_id` ASC),
  CONSTRAINT `fk_mail_account_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE ,
  CONSTRAINT `fk_mail_account_conversation1`
    FOREIGN KEY (`conversation_id`)
    REFERENCES `kidup`.`conversation` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kidup`.`payout_method`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`payout_method` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `address` VARCHAR(45) NOT NULL,
  `city` VARCHAR(45) NOT NULL,
  `zip_code` VARCHAR(45) NOT NULL,
  `country_id` INT(11) NOT NULL,
  `type` VARCHAR(45) NOT NULL,
  `identifier_1` VARCHAR(45) NOT NULL,
  `identifier_2` VARCHAR(45) NOT NULL,
  `created_at` INT NOT NULL,
  `updated_at` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_payout_method_country1_idx` (`country_id` ASC),
  CONSTRAINT `fk_payout_method_country1`
    FOREIGN KEY (`country_id`)
    REFERENCES `kidup`.`country` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kidup`.`child`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`child` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `birthday` INT NULL,
  `gender` VARCHAR(10) NULL,
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_child_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_child_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `kidup`.`user` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kidup`.`item_has_media`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `kidup`.`item_has_media` (
  `item_id` INT NOT NULL,
  `media_id` BIGINT NOT NULL,
  `order` TINYINT NULL,
  PRIMARY KEY (`item_id`, `media_id`),
  INDEX `fk_item_has_media_media1_idx` (`media_id` ASC),
  INDEX `fk_item_has_media_item1_idx` (`item_id` ASC),
  CONSTRAINT `fk_item_has_media_item1`
    FOREIGN KEY (`item_id`)
    REFERENCES `kidup`.`item` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE ,
  CONSTRAINT `fk_item_has_media_media1`
    FOREIGN KEY (`media_id`)
    REFERENCES `kidup`.`media` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
