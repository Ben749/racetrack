<?die;?>
editor.json.gzipped if > 4ko ( min res unit on disk )
split editor contents to individual upon large contents ( editor.4.json )


ggtracker : require sql table named CSF : 

CREATE TABLE `CSF` (`id` int(8) NOT NULL AUTO_INCREMENT,`site` varchar(30) CHARACTER SET latin1 COLLATE latin1_german2_ci NOT NULL,`keyword` varchar(255) CHARACTER SET latin1 COLLATE latin1_german2_ci NOT NULL,`url` varchar(150) NOT NULL DEFAULT '',`ip` varchar(15) NOT NULL,`date` datetime DEFAULT NULL,`time` int(10) unsigned NOT NULL,`hits` int(6) NOT NULL,`Ref` varchar(25) NOT NULL,`titre` varchar(100) CHARACTER SET latin1 COLLATE latin1_german2_ci NOT NULL,`snipet` varchar(255) CHARACTER SET latin1 COLLATE latin1_german2_ci NOT NULL,`histoire` varchar(20) CHARACTER SET latin1 COLLATE latin1_german2_ci NOT NULL,`PR` varchar(3) CHARACTER SET latin1 COLLATE latin1_german2_ci NOT NULL,`position` int(5) NOT NULL DEFAULT '0',`conv` int(5) NOT NULL DEFAULT '0', PRIMARY KEY (`id`),KEY `time` (`time`),KEY `keyword` (`keyword`),KEY `site` (`site`),KEY `url` (`url`)) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
