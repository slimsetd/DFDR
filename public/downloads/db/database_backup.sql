

CREATE TABLE `approval_notify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO approval_notify (id, message, deposit_id, user_id, status, created_at, updated_at) VALUES ('1','deposit Approve with tittle - Lorem Ipsum- Approved','1','9','1','2021-10-14 01:23:30','2021-10-14 01:29:31');


CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_created_by_foreign` (`created_by`),
  KEY `category_updated_by_foreign` (`updated_by`),
  CONSTRAINT `category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('1','Article','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('2','Book','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('3','Conference','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('4','Patent','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('5','Image','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('6','Video','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('7','Dataset','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('8','Audio','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('9','Teaching Resource','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('10','Bachelor','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('11','Thesis Master','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('12','Dissertation','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO category (id, category_name, created_by, updated_by, created_at, updated_at) VALUES ('13','Material Review','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');


CREATE TABLE `degree` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `degree_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `degree_created_by_foreign` (`created_by`),
  KEY `degree_updated_by_foreign` (`updated_by`),
  CONSTRAINT `degree_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `degree_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO degree (id, degree_name, created_by, updated_by, created_at, updated_at) VALUES ('1','Degree 1','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO degree (id, degree_name, created_by, updated_by, created_at, updated_at) VALUES ('2','Degree 2','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO degree (id, degree_name, created_by, updated_by, created_at, updated_at) VALUES ('3','Degree 3','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');


CREATE TABLE `department` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_created_by_foreign` (`created_by`),
  KEY `department_updated_by_foreign` (`updated_by`),
  CONSTRAINT `department_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `department_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO department (id, department_name, created_by, updated_by, created_at, updated_at) VALUES ('1','Department 1','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO department (id, department_name, created_by, updated_by, created_at, updated_at) VALUES ('2','Department 2','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO department (id, department_name, created_by, updated_by, created_at, updated_at) VALUES ('3','Department 3','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');


CREATE TABLE `division` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `division_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `division_created_by_foreign` (`created_by`),
  KEY `division_updated_by_foreign` (`updated_by`),
  CONSTRAINT `division_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `division_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO division (id, division_name, created_by, updated_by, created_at, updated_at) VALUES ('1','Division 1','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO division (id, division_name, created_by, updated_by, created_at, updated_at) VALUES ('2','Division 2','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO division (id, division_name, created_by, updated_by, created_at, updated_at) VALUES ('3','Division 3','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');


CREATE TABLE `faculty` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faculty_created_by_foreign` (`created_by`),
  KEY `faculty_updated_by_foreign` (`updated_by`),
  CONSTRAINT `faculty_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `faculty_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO faculty (id, faculty_name, created_by, updated_by, created_at, updated_at) VALUES ('1','Faculty A','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO faculty (id, faculty_name, created_by, updated_by, created_at, updated_at) VALUES ('2','Faculty B','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO faculty (id, faculty_name, created_by, updated_by, created_at, updated_at) VALUES ('3','Faculty C','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');


CREATE TABLE `instruction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `instruction_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `instruction_created_by_foreign` (`created_by`),
  KEY `instruction_updated_by_foreign` (`updated_by`),
  CONSTRAINT `instruction_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `instruction_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language_created_by_foreign` (`created_by`),
  KEY `language_updated_by_foreign` (`updated_by`),
  CONSTRAINT `language_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `language_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO language (id, language_name, created_by, updated_by, created_at, updated_at) VALUES ('1','Indonesia','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO language (id, language_name, created_by, updated_by, created_at, updated_at) VALUES ('2','English','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO language (id, language_name, created_by, updated_by, created_at, updated_at) VALUES ('3','Italy','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');


CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO migrations (id, migration, batch) VALUES ('1','2014_10_12_000000_create_users_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('2','2014_10_12_100000_create_password_resets_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('3','2019_12_14_000001_create_personal_access_tokens_table','1');

INSERT INTO migrations (id, migration, batch) VALUES ('4','2021_04_25_070048_news','1');

INSERT INTO migrations (id, migration, batch) VALUES ('5','2021_04_25_071423_faculty','1');

INSERT INTO migrations (id, migration, batch) VALUES ('6','2021_04_25_071506_department','1');

INSERT INTO migrations (id, migration, batch) VALUES ('7','2021_04_25_071548_year','1');

INSERT INTO migrations (id, migration, batch) VALUES ('8','2021_04_25_071652_category','1');

INSERT INTO migrations (id, migration, batch) VALUES ('9','2021_04_25_071721_subject','1');

INSERT INTO migrations (id, migration, batch) VALUES ('10','2021_04_25_071754_degree','1');

INSERT INTO migrations (id, migration, batch) VALUES ('11','2021_04_25_071833_language','1');

INSERT INTO migrations (id, migration, batch) VALUES ('12','2021_04_28_081211_division','1');

INSERT INTO migrations (id, migration, batch) VALUES ('13','2021_04_28_081218_instruction','1');

INSERT INTO migrations (id, migration, batch) VALUES ('14','2021_04_28_081547_upload_form','1');

INSERT INTO migrations (id, migration, batch) VALUES ('15','2021_05_03_083447_upload_form_creator','1');

INSERT INTO migrations (id, migration, batch) VALUES ('16','2021_05_03_083511_upload_form_subject','1');

INSERT INTO migrations (id, migration, batch) VALUES ('17','2021_05_03_094858_upload_form_contributor','1');

INSERT INTO migrations (id, migration, batch) VALUES ('18','2021_05_03_094908_upload_form_type','1');

INSERT INTO migrations (id, migration, batch) VALUES ('19','2021_05_03_094915_upload_form_format','1');

INSERT INTO migrations (id, migration, batch) VALUES ('20','2021_05_03_094928_upload_form_identifier','1');

INSERT INTO migrations (id, migration, batch) VALUES ('21','2021_05_03_094942_upload_form_source','1');

INSERT INTO migrations (id, migration, batch) VALUES ('22','2021_05_03_094952_upload_form_coverage','1');

INSERT INTO migrations (id, migration, batch) VALUES ('23','2021_05_03_095011_upload_form_division_information','1');

INSERT INTO migrations (id, migration, batch) VALUES ('24','2021_05_03_095124_upload_form_file','1');

INSERT INTO migrations (id, migration, batch) VALUES ('25','2021_05_11_112059_upload_form_notification','1');

INSERT INTO migrations (id, migration, batch) VALUES ('26','2021_06_08_153904_notification_upload_form','1');

INSERT INTO migrations (id, migration, batch) VALUES ('27','2021_06_08_154039_notification_user_registered','1');

INSERT INTO migrations (id, migration, batch) VALUES ('28','2021_06_11_184406_notification_approval','1');

INSERT INTO migrations (id, migration, batch) VALUES ('29','2021_10_12_041729_software_version','1');


CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_thumb` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `news_thumb_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_created_by_foreign` (`created_by`),
  KEY `news_updated_by_foreign` (`updated_by`),
  CONSTRAINT `news_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `news_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO news (id, news_title, news_desc, news_thumb, news_thumb_name, created_by, updated_by, created_at, updated_at) VALUES ('4','Lorem Ipsums','<p><strong style="color: rgb(0, 0, 0);">Lorem Ipsum</strong><span style="color: rgb(0, 0, 0);">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>','C:\xampp\htdocs\skripsi-master\public/storage/uploads/news_thumb/shark.jpg','shark.jpg','9','9','2021-10-14 01:46:36','2021-10-14 02:10:06');


CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('0b1fcbb8-e78b-4af2-8f33-65e12db1d076','App\Notifications\uploadFormNotification','App\Models\User','1','{"offer_id":666}','','2021-10-14 01:23:35','2021-10-14 01:23:35');

INSERT INTO notifications (id, type, notifiable_type, notifiable_id, data, read_at, created_at, updated_at) VALUES ('25092bba-b23d-48a4-81ba-d2e077dce966','App\Notifications\uploadFormNotification','App\Models\User','1','{"offer_id":666}','','2021-10-14 01:05:04','2021-10-14 01:05:04');


CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES ('1','AppModelsUser','1','myapptoken','890e3fd3deea7afcd08eac20fe5ca751612c1b897fe75d8d3638c996f32c9fba','["*"]','2021-10-12 15:18:02','2021-10-12 15:14:32','2021-10-12 15:18:02');

INSERT INTO personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES ('2','AppModelsUser','6','myapptoken','425638e4e3faab95cbd9b705155f45de487d29ea0c0febb90d0f0d93e77e88fe','["*"]','0000-00-00 00:00:00','2021-10-12 15:19:20','2021-10-12 15:19:20');

INSERT INTO personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES ('3','AppModelsUser','1','myapptoken','4a3fca06258755393ac9c481245bc89b86d7b69e4c004986639132a17705f20e','["*"]','2021-10-12 22:47:47','2021-10-12 22:45:51','2021-10-12 22:47:47');

INSERT INTO personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES ('4','App\Models\User','1','myapptoken','f4d5a91423a19df6275d7396bf2cb020024b24bfff195af9dee93a0527e1ea05','["*"]','2021-10-14 00:42:34','2021-10-14 00:33:18','2021-10-14 00:42:34');

INSERT INTO personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES ('5','App\Models\User','7','myapptoken','1d25b172e7b0441d6f0ad074d66f9c21b173ee0ea99cc9b505bcae7b476bbb25','["*"]','','2021-10-14 00:34:53','2021-10-14 00:34:53');

INSERT INTO personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES ('8','App\Models\User','1','myapptoken','23114ba8fdbd7eaf33ba8e97749be71cefedc7859f4d440be05608e5f968b058','["*"]','2021-10-14 00:51:04','2021-10-14 00:45:12','2021-10-14 00:51:04');

INSERT INTO personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES ('11','App\Models\User','10','myapptoken','c3156f86c2ca04b3302b7384eb4224d790f6e443545df2d7080612e38d99a518','["*"]','','2021-10-14 01:32:20','2021-10-14 01:32:20');

INSERT INTO personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES ('12','App\Models\User','8','myapptoken','5ed5e71118f7f907263540969a23daa26edeb4280f40732fb78b4b5a17ff82f4','["*"]','2021-10-14 03:17:44','2021-10-14 03:16:41','2021-10-14 03:17:44');

INSERT INTO personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, created_at, updated_at) VALUES ('13','App\Models\User','1','myapptoken','a96589196863d80bf2fc3f80a97030948cd58032cfb2c585009352a3dda33208','["*"]','2021-10-14 08:24:01','2021-10-14 08:23:42','2021-10-14 08:24:01');


CREATE TABLE `subject` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject_created_by_foreign` (`created_by`),
  KEY `subject_updated_by_foreign` (`updated_by`),
  CONSTRAINT `subject_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subject_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO subject (id, subject_name, created_by, updated_by, created_at, updated_at) VALUES ('1','Subject A','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO subject (id, subject_name, created_by, updated_by, created_at, updated_at) VALUES ('2','Subject B','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO subject (id, subject_name, created_by, updated_by, created_at, updated_at) VALUES ('3','Subject C','0','0','2021-10-12 15:10:17','0000-00-00 00:00:00');


CREATE TABLE `upload_form` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `language` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `relation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `right_management` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'close',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `upload_for` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_download` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_user_id_foreign` (`user_id`),
  CONSTRAINT `upload_form_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form (id, title, category, description, publisher, date, language, relation, right_management, status, upload_for, total_download, user_id, created_at, updated_at) VALUES ('1','Lorem Ipsum','2','<p><strong style="color: rgb(0, 0, 0);">Lorem Ipsum</strong><span style="color: rgb(0, 0, 0);">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>','Ijul','2021-10-14','2','-','Close','Approved','Editor','0-1','9','2021-10-14 01:05:01','2021-10-14 01:43:12');


CREATE TABLE `upload_form_contributor` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contributor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_contributor_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_form_contributor_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form_contributor (id, contributor, upload_form_id, created_at, updated_at) VALUES ('1','Ijul','1','2021-10-14 01:05:01','2021-10-14 01:05:01');


CREATE TABLE `upload_form_coverage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coverage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_coverage_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_form_coverage_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form_coverage (id, coverage, upload_form_id, created_at, updated_at) VALUES ('1','-','1','2021-10-14 01:05:02','2021-10-14 01:05:02');


CREATE TABLE `upload_form_creator` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `creator` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_creator_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_form_creator_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form_creator (id, creator, upload_form_id, created_at, updated_at) VALUES ('1','Poi','1','2021-10-14 01:05:01','2021-10-14 01:05:01');


CREATE TABLE `upload_form_division` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `division` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_division_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_form_division_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form_division (id, division, upload_form_id, created_at, updated_at) VALUES ('1','Division 2','1','2021-10-14 01:05:02','2021-10-14 01:05:02');


CREATE TABLE `upload_form_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_extention` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_file_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_form_file_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form_file (id, file, file_name, file_size, file_extention, upload_form_id, created_at, updated_at) VALUES ('1','C:\xampp\htdocs\skripsi-master\public/storage/uploads/file_upload/Report_Deposit.pdf','Report_Deposit.pdf','3.713 KB','pdf','1','2021-10-14 01:05:02','2021-10-14 01:05:02');


CREATE TABLE `upload_form_format` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `format` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_format_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_form_format_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form_format (id, format, upload_form_id, created_at, updated_at) VALUES ('1','pdf','1','2021-10-14 01:05:02','2021-10-14 01:05:02');


CREATE TABLE `upload_form_identifier` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identifier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_identifier_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_form_identifier_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form_identifier (id, identifier, upload_form_id, created_at, updated_at) VALUES ('1','-','1','2021-10-14 01:05:02','2021-10-14 01:05:02');


CREATE TABLE `upload_form_source` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_source_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_form_source_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form_source (id, source, upload_form_id, created_at, updated_at) VALUES ('1','www.google.com','1','2021-10-14 01:05:02','2021-10-14 01:05:02');


CREATE TABLE `upload_form_subject` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_subject_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_form_subject_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form_subject (id, subject, upload_form_id, created_at, updated_at) VALUES ('1','Subject B','1','2021-10-14 01:05:01','2021-10-14 01:05:01');


CREATE TABLE `upload_form_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_form_type_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_form_type_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_form_type (id, type, upload_form_id, created_at, updated_at) VALUES ('1','-','1','2021-10-14 01:05:01','2021-10-14 01:05:01');


CREATE TABLE `upload_notify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `upload_form_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `upload_notify_upload_form_id_foreign` (`upload_form_id`),
  CONSTRAINT `upload_notify_upload_form_id_foreign` FOREIGN KEY (`upload_form_id`) REFERENCES `upload_form` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO upload_notify (id, message, status, upload_form_id, created_at, updated_at) VALUES ('1','new deposit with tittle Lorem Ipsum','0','1','2021-10-14 01:05:04','2021-10-14 01:05:04');


CREATE TABLE `user_notify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_notify_user_id_foreign` (`user_id`),
  CONSTRAINT `user_notify_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO user_notify (id, message, status, user_id, created_at, updated_at) VALUES ('1','new user with email arizki.ichwan23@gmail.com','1','6','2021-10-12 15:19:20','2021-10-14 00:33:24');

INSERT INTO user_notify (id, message, status, user_id, created_at, updated_at) VALUES ('3','new user with email amazuraa@gmail.com','1','8','2021-10-14 00:42:23','2021-10-14 00:45:18');

INSERT INTO user_notify (id, message, status, user_id, created_at, updated_at) VALUES ('4','new user with email izul1338@gmail.com','1','9','2021-10-14 00:50:59','2021-10-14 00:51:48');

INSERT INTO user_notify (id, message, status, user_id, created_at, updated_at) VALUES ('5','new user with email izul1339@gmail.com','0','10','2021-10-14 01:32:20','2021-10-14 01:32:20');


CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faculty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `years` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_card` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_card_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approved` tinyint(1) DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO users (id, name, phone, email, place_of_birth, date_of_birth, department, faculty, gender, address, years, upload_card, upload_card_name, photo, role, email_verified_at, password, approved, remember_token, created_at, updated_at) VALUES ('1','Admin','081100001234','admin@mail.com','Bogor','1999-01-01','0','0','L','Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing 
              industries for previewing layouts and visual mockups.','1','http://127.0.0.1:8000/show-image/upload_card/id_card_placeholder.png','id_card_placeholder.png','-','Admin','0000-00-00 00:00:00','$2y$10$2bA/nPGFm4TZjQpxWhsv3e/vAJMn/l9nn1c7x6f8BNyNnB5grxEVS','1','','2021-10-12 15:10:17','0000-00-00 00:00:00');

INSERT INTO users (id, name, phone, email, place_of_birth, date_of_birth, department, faculty, gender, address, years, upload_card, upload_card_name, photo, role, email_verified_at, password, approved, remember_token, created_at, updated_at) VALUES ('8','Ammar Zulfikar','082110109992','amazuraa@gmail.com','Bogor','2021-10-01','2','2','L','Lorem No.101, Bogor, Jawa Barat','4','http://127.0.0.1:8000/show-image/upload_card/whale.jpg','whale.jpg','-','User','','$2y$10$rVMz3WB0y2BAeYGDrifv4OwEyWPSmVnZrWcOxg5I20bhmu0I8vviu','1','','2021-10-14 00:42:23','2021-10-14 00:44:56');

INSERT INTO users (id, name, phone, email, place_of_birth, date_of_birth, department, faculty, gender, address, years, upload_card, upload_card_name, photo, role, email_verified_at, password, approved, remember_token, created_at, updated_at) VALUES ('9','Poi Roo','081100001234','izul1338@gmail.com','Bogor','2021-10-01','0','0','L','Lorem Ipsum No.12, Bogor, jawa barat','0','http://127.0.0.1:8000/show-image/upload_card/whale.jpg','whale.jpg','-','Editor','','$2y$10$PcKcE5oCUxqqxLha1HGkf./uwldSftBfrt.ptOyszYcl2ByjBHxE.','1','','2021-10-14 00:50:59','2021-10-14 01:30:58');

INSERT INTO users (id, name, phone, email, place_of_birth, date_of_birth, department, faculty, gender, address, years, upload_card, upload_card_name, photo, role, email_verified_at, password, approved, remember_token, created_at, updated_at) VALUES ('10','Momon','081100001234','izul1339@gmail.com','Bogor','2021-10-01','2','3','P','Lorem no.103, Bogor, Jawa Barat','6','http://127.0.0.1:8000/show-image/upload_card/whale.jpg','whale.jpg','-','User','','$2y$10$wY2BqK2Y7IfWVFKwIzKMwOK3pRXb2I5o.MKCcYdA6YZr8kmCGNyae','1','','2021-10-14 01:32:19','2021-10-14 01:32:19');


CREATE TABLE `version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `version_detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO version (id, version, version_detail, created_at, updated_at) VALUES ('1','v.0.0.1','<h3>Digital Repository - <strong>v.0.0.1</strong></h3><hr><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>','2021-10-12 15:10:19','0000-00-00 00:00:00');

INSERT INTO version (id, version, version_detail, created_at, updated_at) VALUES ('2','v.0.0.2','<h3>Digital Repository - <strong>v.0.0.2</strong></h3><hr><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>','2021-10-12 15:10:19','0000-00-00 00:00:00');


CREATE TABLE `years` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `years_created_by_foreign` (`created_by`),
  KEY `years_updated_by_foreign` (`updated_by`),
  CONSTRAINT `years_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `years_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO years (id, year, created_by, updated_by, created_at, updated_at) VALUES ('1','2015','0','0','2021-10-12 15:10:18','0000-00-00 00:00:00');

INSERT INTO years (id, year, created_by, updated_by, created_at, updated_at) VALUES ('2','2016','0','0','2021-10-12 15:10:18','0000-00-00 00:00:00');

INSERT INTO years (id, year, created_by, updated_by, created_at, updated_at) VALUES ('3','2017','0','0','2021-10-12 15:10:18','0000-00-00 00:00:00');

INSERT INTO years (id, year, created_by, updated_by, created_at, updated_at) VALUES ('4','2018','0','0','2021-10-12 15:10:18','0000-00-00 00:00:00');

INSERT INTO years (id, year, created_by, updated_by, created_at, updated_at) VALUES ('5','2019','0','0','2021-10-12 15:10:18','0000-00-00 00:00:00');

INSERT INTO years (id, year, created_by, updated_by, created_at, updated_at) VALUES ('6','2020','0','0','2021-10-12 15:10:18','0000-00-00 00:00:00');

INSERT INTO years (id, year, created_by, updated_by, created_at, updated_at) VALUES ('7','2021','0','0','2021-10-12 15:10:18','0000-00-00 00:00:00');
