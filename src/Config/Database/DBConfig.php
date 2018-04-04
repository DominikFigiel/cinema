<?php
	namespace Config\Database;

	class DBConfig{
        //nazwa bazy danych
        public static $databaseName = 'cinema';
        //dane dostępowe do bazy danych
        public static $hostname = 'localhost';
        public static $databaseType = 'mysql';
        public static $port = '3306';
        public static $user = 'root';
        public static $password = '';

		public static $tableGenre = 'Genre';
        public static $tableMovie = 'Movie';
        public static $tableMovieGenre = 'MovieGenre';
        public static $tableProduction = 'Production';
        public static $tableMovieProduction = 'MovieProduction';
        public static $tableActor = 'Actor';
        public static $tableCast = 'Cast';
        public static $tableCinemaHall = "CinemaHall";
        public static $tableLanguageVersion = "LanguageVersion";
        public static $tableMovieType = "MovieType";
        public static $tableShowing = "Showing";
        public static $tableType = "Type";
        public static $tablePricingCategory = "PricingCategory";
        public static $tablePricing = "Pricing";
	}
