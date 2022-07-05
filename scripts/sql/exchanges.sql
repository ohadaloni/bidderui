/*
 * Fri May 15 13:28:07 IDT 2020
 * exchanges require
 *	git cloning
 *	entries in the hosts file
 *  vhost config
 * while a table, it has no UI, just this file,
 * drop table remains so the data is the same except changes
 */
/*------------------------------------------------------------*/
drop table if exists exchanges;
/*------------------------------------------------------------*/
create table exchanges (
  id int auto_increment,
  vhost varchar(30),
  name varchar(100),
  primary key (id),
  unique key ( vhost )
);
insert exchanges ( id, vhost, name ) values
	( 1, "theora1", "theora1" )
	,( 2, "theora2", "theora2" )
	,( 3, "smaato", "Smaato" )
	,( 4, "mopub", "MoPub" )
	,( 5, "axonix", "Axonix" )
	,( 6, "adx", "AdX" )
	,( 7, "vdopia", "Vdopia" )
	,( 8, "adxperience", "Adxperience" )
	,( 9, "flurry", "Flurry" )
	,( 10, "mobfox", "MobFox" )
	,( 11, "openx", "OpenX" )
	,( 12, "onebyaol", "One by AOL" )
	,( 13, "appnexus", "appNexus" )
	,( 14, "verizon", "Verizon Media" )
	,( 15, "rubicon", "Rubicon Project" )
	,( 16, "pubmatic", "PubMatic" )
	,( 17, "indexexchange", "Index Exchange" )
	,( 18, "smartyads", "SmartyAds" )
;
/*------------------------------------------------------------*/
