#
# Add SQL definition of database tables
#
--
-- Table structure for table 'tt_content'
--
CREATE TABLE tt_content (
    tx_ucph_content_tables_enable_datatable tinyint(4) unsigned DEFAULT 0 NOT NULL,
    tx_ucph_content_tables_datatable_columnpicker int(12) unsigned DEFAULT 0 NOT NULL,
    tx_ucph_content_tables_datatable_columnsort varchar(128) DEFAULT '' NOT NULL,
);