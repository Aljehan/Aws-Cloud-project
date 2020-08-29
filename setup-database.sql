CREATE TABLE timetable(
  code varchar(7),
  day varchar(20) NOT NULL,
  time varchar(10) NOT NULL,
  PRIMARY KEY (code)
);

INSERT INTO timetable VALUES ('COSC326','Wednesday','10:00 am');
INSERT INTO timetable VALUES ('COSC349','Tuesday','1:00 pm');
