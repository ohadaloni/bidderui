
DROP TABLE IF EXISTS blackListItems;
CREATE TABLE blackListItems (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  blackListId int(11) DEFAULT NULL,
  domain varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY blackListId (blackListId,domain)
);


DROP TABLE IF EXISTS blackLists;
CREATE TABLE blackLists (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS cCntDay;
CREATE TABLE cCntDay (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  campaignId int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY campaignId (campaignId,`date`)
);


DROP TABLE IF EXISTS cCntHour;
CREATE TABLE cCntHour (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  campaignId int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY campaignId (campaignId,`date`,`hour`)
);


DROP TABLE IF EXISTS cCntMinute;
CREATE TABLE cCntMinute (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  campaignId int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY campaignId (campaignId,`date`,`hour`,`minute`)
);


DROP TABLE IF EXISTS cCntMonth;
CREATE TABLE cCntMonth (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  campaignId int(11) DEFAULT NULL,
  `month` varchar(8) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY campaignId (campaignId,`month`)
);


DROP TABLE IF EXISTS cCntYear;
CREATE TABLE cCntYear (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  campaignId int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY campaignId (campaignId,`year`)
);


DROP TABLE IF EXISTS campaignBlackLists;
CREATE TABLE campaignBlackLists (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  campaignId int(11) DEFAULT NULL,
  blackListId int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY campaignId (campaignId,blackListId)
);


DROP TABLE IF EXISTS campaignWhiteLists;
CREATE TABLE campaignWhiteLists (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  campaignId int(11) DEFAULT NULL,
  whiteListId int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY campaignId (campaignId,whiteListId)
);


DROP TABLE IF EXISTS campaigns;
CREATE TABLE campaigns (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `owner` varchar(40) DEFAULT NULL,
  kind varchar(40) DEFAULT NULL,
  onSwitch int(11) DEFAULT NULL,
  dailyBudget double DEFAULT NULL,
  baseBid double DEFAULT NULL,
  maxBid double DEFAULT NULL,
  desiredProfitMargin int(11) DEFAULT NULL,
  geo varchar(6) DEFAULT NULL,
  banner varchar(255) DEFAULT NULL,
  adm text,
  landingPage text,
  hours varchar(255) DEFAULT NULL,
  w int(11) DEFAULT NULL,
  h int(11) DEFAULT NULL,
  audience varchar(12) DEFAULT NULL,
  lastUpdated datetime DEFAULT NULL,
  lastUpdatedBy varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
);


DROP TABLE IF EXISTS cntDay;
CREATE TABLE cntDay (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`)
);


DROP TABLE IF EXISTS cntHour;
CREATE TABLE cntHour (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`,`hour`)
);


DROP TABLE IF EXISTS cntMinute;
CREATE TABLE cntMinute (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`,`hour`,`minute`)
);


DROP TABLE IF EXISTS cntMonth;
CREATE TABLE cntMonth (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` varchar(8) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `month` (`month`)
);


DROP TABLE IF EXISTS cntYear;
CREATE TABLE cntYear (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` int(11) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `year` (`year`)
);


DROP TABLE IF EXISTS controlPanel;
CREATE TABLE controlPanel (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  updatedBy varchar(60) DEFAULT NULL,
  onOff int(11) DEFAULT NULL,
  dailyBudget int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
);


DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(6) DEFAULT NULL,
  code3 varchar(6) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  UNIQUE KEY code3 (code3)
) ENGINE=MyISAM AUTO_INCREMENT=243 DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS exCntDay;
CREATE TABLE exCntDay (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  exchangeId int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY exchangeId (exchangeId,`date`)
);


DROP TABLE IF EXISTS exCntHour;
CREATE TABLE exCntHour (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  exchangeId int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY exchangeId (exchangeId,`date`,`hour`)
);


DROP TABLE IF EXISTS exCntMinute;
CREATE TABLE exCntMinute (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  exchangeId int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY exchangeId (exchangeId,`date`,`hour`,`minute`),
  KEY `date` (`date`,`hour`,`minute`)
);


DROP TABLE IF EXISTS exCntMonth;
CREATE TABLE exCntMonth (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  exchangeId int(11) DEFAULT NULL,
  `month` varchar(8) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY exchangeId (exchangeId,`month`)
);


DROP TABLE IF EXISTS exCntYear;
CREATE TABLE exCntYear (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  exchangeId int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY exchangeId (exchangeId,`year`)
);


DROP TABLE IF EXISTS exchangeTraffic;
CREATE TABLE exchangeTraffic (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  strength int(11) DEFAULT NULL,
  kind varchar(4) DEFAULT NULL,
  w int(11) DEFAULT NULL,
  h int(11) DEFAULT NULL,
  geo varchar(4) DEFAULT NULL,
  gender varchar(4) DEFAULT NULL,
  ageGroup varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS exchanges;
CREATE TABLE exchanges (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  vhost varchar(30) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY vhost (vhost)
);


DROP TABLE IF EXISTS plCntDay;
CREATE TABLE plCntDay (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  placementId varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY placementId (placementId,`date`)
);


DROP TABLE IF EXISTS plCntHour;
CREATE TABLE plCntHour (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  placementId varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY placementId (placementId,`date`,`hour`)
);


DROP TABLE IF EXISTS plCntMinute;
CREATE TABLE plCntMinute (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  placementId varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY placementId (placementId,`date`,`hour`,`minute`),
  KEY `date` (`date`,`hour`,`minute`)
);


DROP TABLE IF EXISTS plCntMonth;
CREATE TABLE plCntMonth (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  placementId varchar(255) DEFAULT NULL,
  `month` varchar(8) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY placementId (placementId,`month`)
);


DROP TABLE IF EXISTS plCntYear;
CREATE TABLE plCntYear (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  placementId varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  bidRequests int(11) DEFAULT NULL,
  bids int(11) DEFAULT NULL,
  wins int(11) DEFAULT NULL,
  cost double DEFAULT NULL,
  views int(11) DEFAULT NULL,
  clicks int(11) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY placementId (placementId,`year`)
);


DROP TABLE IF EXISTS revenue;
CREATE TABLE revenue (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  exchangeId int(11) DEFAULT NULL,
  campaignId int(11) DEFAULT NULL,
  bidRequestId varchar(255) DEFAULT NULL,
  bidId varchar(255) DEFAULT NULL,
  placementId varchar(255) DEFAULT NULL,
  revenue double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY exchangeId (exchangeId),
  KEY campaignId (campaignId),
  KEY `date` (`date`,`hour`,`minute`),
  KEY placementId (placementId)
);


DROP TABLE IF EXISTS taskAttachments;
CREATE TABLE taskAttachments (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  taskId int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  fileName varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY taskId (taskId)
);


DROP TABLE IF EXISTS taskComments;
CREATE TABLE taskComments (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  taskId int(11) DEFAULT NULL,
  `comment` text,
  createdOn datetime DEFAULT NULL,
  createdBy varchar(40) DEFAULT NULL,
  lastChange datetime DEFAULT NULL,
  lastChangeBy varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY taskId (taskId)
);


DROP TABLE IF EXISTS taskPriorities;
CREATE TABLE taskPriorities (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  priority varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS taskStatuses;
CREATE TABLE taskStatuses (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS tasks;
CREATE TABLE tasks (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) DEFAULT NULL,
  description text,
  priority varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  assigned varchar(20) DEFAULT NULL,
  createdOn datetime DEFAULT NULL,
  createdBy varchar(20) DEFAULT NULL,
  lastChange datetime DEFAULT NULL,
  lastChangeBy varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY title (title),
  KEY lastChange (lastChange),
  KEY assigned (assigned),
  KEY `status` (`status`)
);


DROP TABLE IF EXISTS timewatch;
CREATE TABLE timewatch (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `month` varchar(8) DEFAULT NULL,
  `date` date DEFAULT NULL,
  timeIn datetime DEFAULT NULL,
  timeOut datetime DEFAULT NULL,
  timeIn2 datetime DEFAULT NULL,
  timeOut2 datetime DEFAULT NULL,
  timeIn3 datetime DEFAULT NULL,
  timeOut3 datetime DEFAULT NULL,
  totalTime int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`,`date`)
);


DROP TABLE IF EXISTS users;
CREATE TABLE users (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  loginName varchar(255) DEFAULT NULL,
  passwd varchar(255) DEFAULT NULL,
  loginType varchar(20) DEFAULT NULL,
  landHere text,
  PRIMARY KEY (`id`),
  UNIQUE KEY loginName (loginName)
);


DROP TABLE IF EXISTS whiteListItems;
CREATE TABLE whiteListItems (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  whiteListId int(11) DEFAULT NULL,
  domain varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY whiteListId (whiteListId)
);


DROP TABLE IF EXISTS whiteLists;
CREATE TABLE whiteLists (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS wins;
CREATE TABLE wins (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `hour` int(11) DEFAULT NULL,
  `minute` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  exchangeId int(11) DEFAULT NULL,
  campaignId int(11) DEFAULT NULL,
  bidRequestId varchar(255) DEFAULT NULL,
  bidId varchar(255) DEFAULT NULL,
  placementId varchar(255) DEFAULT NULL,
  cost double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY exchangeId (exchangeId),
  KEY campaignId (campaignId),
  KEY `date` (`date`,`hour`,`minute`),
  KEY placementId (placementId)
);




