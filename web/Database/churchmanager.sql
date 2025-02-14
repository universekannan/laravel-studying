CREATE TABLE `address` (
  `ADDRESS_ID` varchar(10) NOT NULL,
  `ADDRESS_1` varchar(100) NOT NULL,
  `ADDRESS_2` varchar(100) NOT NULL,
  `CITY` varchar(100) NOT NULL,
  `STATE_ID` varchar(10) NOT NULL,
  `ZIP` varchar(15) NOT NULL,
  `COUNTRY_ID` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `carecells` (
  `CARECELL_ID` varchar(10) NOT NULL,
  `CARECELL_NAME` varchar(100) NOT NULL,
  `LOCATION` varchar(100) NOT NULL,
  `LEADER` varchar(100) NOT NULL,
  `MODIFIED_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `carecells_families` (
  `CARECELL_ID` varchar(10) NOT NULL,
  `FAMILY_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `churches_families` (
  `CHURCH_ID` varchar(25) NOT NULL,
  `FAMILY_ID` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `churches_members` (
  `CHURCH_ID` varchar(10) NOT NULL,
  `MEMBER_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `deleted_address` (
  `ADDRESS_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `deleted_carecells` (
  `CARECELL_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `deleted_child` (
  `CHILD_ID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `deleted_churches` (
  `CHURCH_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `deleted_families` (
  `FAMILY_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `deleted_members` (
  `MEMBER_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `families` (
  `FAMILY_ID` varchar(10) NOT NULL,
  `ADDRESS_ID` varchar(15) NOT NULL,
  `CHURCH_ID` varchar(10) NOT NULL,
  `CARECELL_ID` varchar(10) NOT NULL,
  `FAMILY_NAME` varchar(100) NOT NULL,
  `ACTIVE` varchar(50) NOT NULL,
  `YEARLY_OFFERING` double NOT NULL,
  `LAST_MODIFIED_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `families_members` (
  `FAMILY_ID` varchar(10) NOT NULL,
  `MEMBER_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `family_address` (
  `ADDRESS_ID` varchar(25) NOT NULL,
  `FAMILY_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `members` (
  `MEMBER_ID` varchar(10) NOT NULL,
  `MEMBER_TITLE` varchar(15) NOT NULL,
  `MEMBER_FIRST_NAME` varchar(100) NOT NULL,
  `MEMBER_LAST_NAME` varchar(100) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `MOBILE_NUMBER` varchar(50) NOT NULL,
  `DATE_OF_BIRTH` date NOT NULL,
  `OFFERING` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `member_address` (
  `MEMBER_ID` varchar(10) NOT NULL,
  `ADDRESS_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `offerings` (
  `OFFERING_ID` varchar(10) NOT NULL,
  `MEMBER_FIRST_NAME` varchar(25) NOT NULL,
  `OFFERING_AMOUNT` varchar(15) NOT NULL,
  `OFFERING_PAYMENT` varchar(25) NOT NULL,
  `OFFERING_TYPE` varchar(25) NOT NULL,
  `MEMBER_ID` varchar(10) NOT NULL,
  `OFFERING_DATE` date NOT NULL,
  `CURRENT_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `offering_types` (
  `OFFERING_TYPE_ID` varchar(5) NOT NULL,
  `OFFERING_TYPE_VALUE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sunday_class` (
  `SUNDAY_CLASS_ID` varchar(5) NOT NULL,
  `SUNDAY_CLASS_NAME` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `sunday_class_children` (
  `CHILD_ID` varchar(10) NOT NULL,
  `MEMBER_ID` varchar(25) NOT NULL,
  `FAMILY_ID` varchar(25) NOT NULL,
  `AGE` int(5) NOT NULL,
  `DATE_OF_BIRTH` date NOT NULL,
  `CLASS` varchar(20) NOT NULL,
  `REWARDS` int(200) NOT NULL,
  `EMAIL` varchar(20) NOT NULL,
  `CONTACT_NUMBER` varchar(50) NOT NULL,
  `MODIFIED_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `sunday_class_members` (
  `SUNDAY_CLASS_ID` varchar(5) NOT NULL,
  `MEMBER_ID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `users` (
  `NAME` varchar(50) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PASSWORD` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



ALTER TABLE `address`
  ADD PRIMARY KEY (`ADDRESS_ID`);

ALTER TABLE `churches`
  ADD PRIMARY KEY (`CHURCH_ID`);

ALTER TABLE `deleted_child`
  ADD PRIMARY KEY (`CHILD_ID`);

ALTER TABLE `sunday_class_children`
  ADD PRIMARY KEY (`CHILD_ID`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`EMAIL`);
COMMIT;