
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `email` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


TRUNCATE `admin`;
INSERT INTO `admin` (`email`, `password`, `on`) VALUES
('admin@howstack.com',	'd8ed7457a3464c783a4485c5173c8adce2210c1a',	'2018-08-13 08:10:40');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `permalink` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

TRUNCATE `categories`;
INSERT INTO `categories` (`catid`, `name`, `permalink`, `description`, `status`, `on`) VALUES
(1,	'web',	'web',	'Do not use this tag. For questions related to an aspect of the world wide web, use a more specific tag for it, such as [uri], [html], [http] or [w3c].',	1,	'2018-07-19 07:26:36'),
(2,	'php',	'php',	'PHP is a widely used, high-level, dynamic, object-oriented and interpreted scripting language primarily designed for server-side web development. ',	1,	'2018-07-19 07:26:43'),
(3,	'Java Script',	'java-script',	'JavaScript (not to be confused with Java) is a high-level, dynamic, multi-paradigm, weakly-typed language used for both client-side and server-side scripting. Its primary use is in rendering and allowing manipulation of web pages. Use this tag for questions regarding ECMAScript and its various dialects/implementations (excluding ActionScript and Google-Apps-Script).',	1,	'2018-07-24 08:42:28'),
(4,	'Jquery',	'jquery',	'jQuery is a popular cross-browser JavaScript library that facilitates Document Object Model (DOM) traversal, event handling, animations, and AJAX interactions by minimizing the discrepancies across browsers. A question tagged jquery should be related to jquery, so jquery should be used by the code in question and at least a jquery usage-related elements need to be in the question.',	1,	'2018-07-24 08:42:48'),
(5,	'CodeIgnitor',	'codeignitor',	'CodeIgniter is an open-source PHP web development framework created by EllisLab Inc and it has been adopted by British Columbia Institute of Technology. The framework implements a modified version of the Model-View-Controller design pattern. Use this tag for questions about CodeIgniter classes, methods, functions, syntax and use PHP web development framework created by EllisLab Inc and it has been adopted by British Columbia Institute of Technology. ',	1,	'2018-07-24 08:43:09'),
(6,	'ASP.net',	'aspnet',	'ASP.NET is a Microsoft web application development framework that allows programmers to build dynamic web sites, web applications and web services. It is useful to use this tag in conjunction with the project type tag e.g. [asp.net-mvc], [asp.net-webforms], or [asp.net-web-api]. Do NOT use this tag for questions about ASP.NET Core - use [asp.net-core] instead.',	1,	'2018-07-24 08:43:39'),
(7,	'Java',	'java',	'Java (not to be confused with JavaScript or JScript or JS) is a general-purpose object-oriented programming language designed to be used in conjunction with the Java Virtual Machine (JVM). \"Java platform\" is the name for a computing system that has installed tools for developing and running Java programs. Use this tag for questions referring to the Java programming language or Java platform tools. ',	1,	'2018-07-24 08:43:55'),
(8,	'HTML',	'html',	'HTML (Hyper Text Markup Language) is the standard markup language used for structuring web pages and formatting content. HTML describes the structure of a website semantically along with cues for presentation, making it a markup language, rather than a programming language. HTML works in conjunction primarily with CSS and JavaScript, adding presentation and behaviour to the pages. The most recent revision to the HTML specification is HTML5.2. ',	1,	'2018-07-24 08:46:53'),
(9,	'CSS',	'css',	'CSS (Cascading Style Sheets) is a representation style sheet language used for describing the look and formatting of HTML (Hyper Text Markup Language), XML (Extensible Markup Language) documents and SVG elements including (but not limited to) colors, layout, fonts, and animations.',	1,	'2018-07-24 08:48:12'),
(10,	'Apache Server',	'apache_server',	'Use this tag (along with an appropriate programming-language tag) for programming questions relating to the Apache HTTP Server. Do not use this tag for questions about other Apache Foundation products. Note that server configuration questions are usually a better fit on https://serverfault.com',	1,	'2018-07-24 08:49:11'),
(11,	'C Language',	'language/c',	'C is a general-purpose computer programming language used for operating systems, libraries, games and other high performance work. This tag should be used with general questions concerning the C language, as defined in the ISO 9899:2011 standard. If applicable, include a version-specific tag such as c99 or c90 for questions relating to older language standards. C is distinct from C++ and it should not be combined with the C++ tag absent a rational reason.',	1,	'2018-07-24 08:51:33'),
(12,	'C#',	'language/csharp',	'C# (pronounced \"see sharp\") is a high level, object-oriented programming language that is designed for building a variety of applications that run on the .NET Framework (or .NET Core). C# is simple, powerful, type-safe, and object-oriented.',	1,	'2018-07-24 08:53:29'),
(13,	'Data Structure',	'data-structure',	'A data structure is a way of organizing data in a fashion that allows particular properties of that data to be queried and/or updated efficiently. ',	1,	'2018-07-24 08:55:25'),
(14,	'Ajax',	'ajax',	'AJAX (Asynchronous JavaScript and XML) is a technique for creating seamless interactive websites via asynchronous data exchange between client and server. AJAX facilitates communication with the server or partial page updates without a traditional page refresh.',	1,	'2018-07-24 08:56:37'),
(15,	'Sql',	'language/sql',	'Structured Query Language (SQL) is a language for querying databases. Questions should include code examples, table structure, sample data, and a tag for the DBMS implementation (e.g. MySQL, PostgreSQL, Oracle, MS SQL Server, IBM DB2, etc.) being used. If your question relates solely to a specific DBMS (uses specific extensions/features), use that DBMS\'s tag instead. Answers to questions tagged with SQL should use ISO/IEC standard SQL.',	1,	'2018-07-24 11:51:25'),
(16,	'Mongodb',	'language/mongodb',	'MongoDB is a scalable, high-performance, open source, document-oriented NoSQL database. It supports a large number of languages and application development platforms. Questions about server administration can be asked on http://dba.stackexchange.com.',	1,	'2018-07-24 11:53:58'),
(17,	'Wordpress',	'language/wordpress',	'This tag is for programming-specific questions related to the content management system WordPress. Questions about theme development, WordPress administration, management best practices, and server configuration are off-topic here and best asked on Stack Exchange WordPress Development. ',	1,	'2018-07-24 11:56:34'),
(18,	'Android',	'language/andriod',	'Android is Google\'s mobile operating system, used for programming or developing digital devices (Smartphones, Tablets, Automobiles, TVs, Wear, Glass, IoT). For topics related to Android, use Android-specific tags such as android-intent, not intent, android-activity, not activity, android-adapter, not adapter etc. For questions other than development or programming, but related to Android framework, use the link: https://android.stackexchange.com. ',	1,	'2018-07-24 11:57:39'),
(19,	'C++',	'language/c++',	'C++ is a general-purpose programming language. It was originally designed as an extension to C, and keeps a similar syntax, but is now a completely different language. Use this tag for questions about code (to be) compiled with a C++ compiler. Use a version specific tag for questions related to a specific standard revision [C++11], [C++17], etc.',	1,	'2018-07-24 12:03:03'),
(20,	'Python',	'language/python',	'Python is a dynamic, strongly typed, object-oriented, multipurpose programming language, designed to be quick (to learn, to use, and to understand), and to enforce a clean and uniform syntax. Two similar but incompatible versions of Python are in use (Python 2.7 or 3.x). For version-specific Python questions, please also use the [python-2.7] or [python-3.x] tags. When using a Python variant (Jython, Pypy, Iron-python, etc.) - please also tag the variant. ',	1,	'2018-07-24 12:03:31'),
(21,	'AngularJS',	'language/angularjs',	'Use for questions about AngularJS (1.x), the open-source JavaScript framework. Do NOT use this tag for Angular 2 or later versions; instead, use the [angular] tag.',	1,	'2018-07-24 12:04:31'),
(22,	'Node.js',	'language/node.js',	'Node.js is an event-based, non-blocking, asynchronous I/O framework that uses Google\'s V8 JavaScript engine and libuv library. It is used for developing applications that make heavy use of the ability to run JavaScript both on the client, as well as on server side and therefore benefit from the re-usability of code and the lack of context switching.',	1,	'2018-07-24 12:05:19'),
(23,	'Swift',	'language/swift',	'Swift is a general-purpose, open-source programming language developed by Apple Inc. for their platforms and Linux. Use the tag only for questions about language features, or requiring code in Swift. Use the tags [ios], [osx], [watch-os], [tvos], [cocoa-touch], and [cocoa] for (language-agnostic) questions about the platforms or frameworks.',	1,	'2018-07-24 12:05:49'),
(24,	'VB.Net',	'language/vb.net',	'Visual Basic.NET (VB.NET) is a multi-paradigm, managed, type-safe, object-oriented computer programming language. Along with C# and F#, it is one of the main languages targeting the .NET Framework. VB.NET can be viewed as an evolution of Microsoft\'s Visual Basic 6 (VB6) but implemented on the Microsoft .NET Framework. DO NOT USE this tag for VB6, VBA or VBScript questions.',	1,	'2018-07-24 12:06:28'),
(25,	'ReactJs',	'language/reactjs',	'React is a JavaScript library for building user interfaces. It uses a declarative paradigm and aims to be both efficient and flexible.',	1,	'2018-07-24 12:09:24'),
(26,	'Web Sockets',	'language/websocket',	'WebSocket is an API built on top of TCP sockets and a protocol for bi-directional, full-duplex communication between client and server without the overhead of HTTP.',	1,	'2018-07-24 12:10:53'),
(27,	'Yii',	'language/yii',	'Use for questions about any version of Yii, an open-source MVC framework for writing web 2.0 applications in PHP5+',	1,	'2018-07-24 12:14:51'),
(28,	'Cordova',	'language/cordova',	'Apache Cordova (formerly PhoneGap) is a framework that allows developers to create cross-platform mobile applications using web technologies like HTML, JavaScript, and CSS. ',	1,	'2018-07-24 12:16:19'),
(29,	'iOS',	'language/ios',	'iOS is the mobile operating system running on the Apple iPhone, iPod touch, and iPad. Use this tag [ios] for questions related to programming on the iOS platform. Use the related tags [objective-c] and [swift] for issues specific to those programming languages.',	1,	'2018-07-24 12:17:05'),
(30,	'Xamarin',	'language/xamarin',	'Xamarin is a platform consisting of Xamarin.iOS, Xamarin.Android, Xamarin.Mac and Xamarin Test Cloud. It allows you to write cross-platform native Apps for iOS, Android and Mac and follow your app through its entire lifecycle. The introduction of Xamarin.Forms supports Native UI development for iOS, Android and Windows ',	1,	'2018-07-24 12:17:57'),
(31,	'Numpy',	'language/numpy',	'NumPy is a scientific and numerical computing extension to the Python programming language.',	1,	'2018-07-24 12:20:52'),
(32,	'Jython',	'language/jython',	'Jython is an open-source implementation of the Python programming language in Java.',	1,	'2018-07-24 12:21:26'),
(33,	'Scipy',	'language/scipy',	'SciPy is an open source library of algorithms and mathematical tools for the Python programming language.',	1,	'2018-07-24 12:22:08'),
(34,	'ASP.Net Core',	'language/asp.netcore',	'ASP.NET Core is a lean, composable and cross-platform framework for building web and cloud applications. It is fully open source on GitHub. ASP.NET Core apps can be run on Windows with the full .NET Framework or smaller .NET Core, or on Linux and MacOS with .NET Core and Mono.',	1,	'2018-07-24 12:23:15'),
(35,	'ASP.Net MVC',	'language/asp.netmvc',	'The ASP.NET MVC Framework is an open source web application framework and tooling that implements a version of the model-view-controller (MVC) pattern tailored towards web applications and built upon an ASP.NET technology foundation.',	1,	'2018-07-24 12:23:42'),
(36,	'Linq',	'language/linq',	'Language Integrated Query (LINQ) is a Microsoft .NET Framework component that adds native data querying capabilities to .NET languages. Please consider using more detailed tags when appropriate, for example [linq-to-sql], [linq-to-entities] / [entity-framework], or [plinq]',	1,	'2018-07-24 12:25:11'),
(37,	'XML',	'language/xml',	'Extensible Markup Language (XML) is a flexible, structured document format that defines human- and machine-readable encoding rules.',	1,	'2018-07-24 12:26:16'),
(38,	'Drupal',	'language/drupal',	'Drupal is an open source CMS framework written in PHP. *IMPORTANT* Rather than using this tag, consider posting your question directly on https://drupal.stackexchange.com/. Also, because of substantial differences between major versions, consider using either the drupal-6, drupal-7 or drupal-8 tags.',	1,	'2018-07-24 12:27:25'),
(39,	'Firebase',	'language/firebase',	'Firebase is a serverless platform for unified development of applications for mobile devices and for the Web.',	1,	'2018-07-24 12:27:53'),
(40,	'Joomla',	'language/joomla',	'Joomla! is a free and open source Content Management System (CMS) for publishing content on the World Wide Web and intranets and a model–view–controller (MVC) Web application framework that can also be used independently. Joomla questions can also be asked on https://joomla.stackexchange.com/ ',	1,	'2018-07-24 12:28:40'),
(41,	'Laravel',	'laravel',	'Laravel is an open-source PHP web framework, following the MVC pattern.',	1,	'2018-07-24 12:29:37'),
(42,	'Shell',	'language/shell',	'The term \'shell\' refers to a general class of text-based interactive command interpreters most often associated with the Unix & Linux operating systems. For questions about shell scripting, please use a more specific tag such as \'bash\', \'powershell\' or \'ksh\'. Without a specific tag, a portable (POSIX-compliant) solution should be assumed, though using \'posix\' in addition or \'sh\' instead is preferable.',	1,	'2018-07-30 06:48:08'),
(43,	'Nightwatch.js',	'language/nightwatch',	'Nightwatch.js is an easy to use Node.js based End-to-End (E2E) testing solution for browser based apps and websites.',	1,	'2018-07-30 06:51:05'),
(44,	'API',	'api',	'DO NOT USE: Tag with the library you mean, [api-design], or something else appropriate instead. Questions asking us to recommend or find an API are off-topic.',	1,	'2018-07-30 06:58:35'),
(45,	'Matlab',	'language/matlab',	'MATLAB is a high-level language and interactive programming environment for numerical computation and visualization developed by MathWorks. Questions should be tagged with either [tag:matlab] or [tag:octave], but not both, unless the question explicitly involves both packages. When using this tag, please mention the MATLAB release you\'re working with (e.g. R2017a).',	1,	'2018-07-30 07:15:30'),
(46,	'NativeScript',	'language/nativescript',	'NativeScript is an open source framework created by Telerik that makes native mobile app development easier for web developers. It enables developers to use JavaScript or TypeScript (with or without Angular or Vue) to build native mobile applications for iOS and Android. NativeScript apps render native UI components styled by a subset of CSS. Modules provide cross-platform native API abstractions. 100% of native APIs are available via JavaScript.',	1,	'2018-07-30 07:36:51'),
(47,	'spreadsheet',	'spreadsheet',	'Use this tag for questions about spreadsheet apps, plug-ins, libraries, etc., where no more specific tag exists. A spreadsheet presents tabular data sets arranged in rows and columns, typically with tools for capturing, analyzing, and collaborating on that data. Each cell may contain alphanumeric text, numeric values, or formulas. ',	1,	'2018-07-30 07:52:57'),
(49,	'.NET',	'visual-net',	'The .NET framework is a software framework designed mainly for the Microsoft Windows operating system. It includes an implementation of the Base Class Library, Common Language Runtime (commonly referred to as CLR), Common Type System (commonly referred to as CTS) and Dynamic Language Runtime. It supports many programming languages, including C#, VB.NET, F# and C++/CLI. Do NOT use for questions about .NET Core.',	1,	'2018-08-01 10:29:32'),
(50,	'GIT',	'git',	'Git is an open-source distributed version control system (DVCS). Use this tag for questions related to Git usage and workflows. Do not use this tag for general programming questions that happen to involve a Git repository.',	1,	'2018-08-01 11:12:32'),
(51,	'Algorithms',	'algorithms',	'An algorithm is a sequence of well-defined steps that defines an abstract solution to a problem. Use this tag when your issue is related to algorithm design.',	1,	'2018-08-02 05:36:43'),
(52,	'Action Script',	'action-script',	'ActionScript is a scripting language used to create Rich Internet Applications (RIA), mobiles applications, web applications, etc. It is the main language for Flash and Flex.',	1,	'2018-08-02 05:44:45'),
(54,	'Rest Apis',	'rest-api',	'A RESTful API is an application program interface (API) that uses HTTP requests to GET, PUT, POST and DELETE data.',	1,	'2018-08-02 05:48:41'),
(55,	'Type Script',	'type-script',	'TypeScript is a typed superset of JavaScript created by Microsoft that adds optional types, classes, async/await, and many other features, and compiles to plain JavaScript. This tag is for questions specific to TypeScript. It is not used for general JavaScript questions.',	1,	'2018-08-02 06:42:01'),
(56,	'Bash Script',	'bash-script',	'For questions about scripts written for the Bash command shell. For shell scripts with errors, please check them with the shellcheck program (or in the web shellcheck server at https://shellcheck.net) before posting here. Questions about interactive use of Bash are more likely to be on-topic on Super User than on Stack Overflow.',	1,	'2018-08-02 07:35:25'),
(57,	'Linux',	'linux',	'LINUX QUESTIONS MUST BE PROGRAMMING RELATED. Use this tag only if your question relates to programming using Linux APIs or Linux-specific behavior, not just because you happen to run your code on Linux. If you need Linux support you can try https://unix.stackexchange.com or https://askubuntu.com',	1,	'2018-08-02 08:40:28'),
(58,	'Mysql',	'language/mysql',	'MySQL is a free, open source Relational Database Management System (RDBMS) that uses Structured Query Language (SQL). DO NOT USE this tag for other DBs such as SQL Server, SQLite etc. These are different DBs which all use SQL to manage the data.',	1,	'2018-08-02 10:44:24'),
(59,	'Docker',	'language/docker',	'Docker provides a high-level API to containerize processes and applications with some degree of isolation and repeatability across servers. Docker supports both Linux and Windows containers.',	1,	'2018-08-02 11:26:38'),
(60,	'GitHub',	'github',	'GitHub is a web-based hosting service for software development projects that use Git for version control. Use this tag for questions specific to problems with repositories hosted on GitHub, features specific to GitHub and using GitHub for collaborating with other users. Do not use this tag for Git-related issues simply because a repository happens to be hosted on GitHub.',	1,	'2018-08-02 11:44:53'),
(61,	'Ruby',	'ruby',	'',	1,	'2018-08-02 11:52:07'),
(62,	'Flash',	'flash',	'For questions on Adobe\'s cross-platform multimedia runtime used to embed animations, video, and interactive applications into web pages. For questions related to memory, use the tag [flash-memory].',	1,	'2018-08-02 12:09:02'),
(63,	'UNIX',	'unix',	'The Unix operating system is a general purpose OS that was developed by Bell Labs in the late 1960s and today exists in various versions. Important note: This tag is exclusively for programming questions that are directly related to Unix; general software issues should be directed to the Unix & Linux Stack Exchange site or to Super User.',	1,	'2018-08-03 06:28:25'),
(64,	'Dart',	'dart',	'',	1,	'2018-08-03 07:14:42'),
(65,	'R',	'languages/r',	'R is a free, open-source programming language and software environment for statistical computing, bioinformatics, visualization and general computing. Provide minimal, reproducible, representative example(s) with your questions. Use dput() for data and specify all non-base packages with library calls. Do not embed pictures for data or code, use indented code blocks.',	1,	'2018-08-03 07:26:05'),
(66,	'Math',	'math',	'Mathematics is the study of quantity, structure, space, and change. Any math questions on this site should be programming related.',	1,	'2018-08-03 08:04:29'),
(67,	'Editor',	'editor',	'This tag is for questions about the features and functionality of text editors, source code editors and other programs specifically designed for modifying plain text files used in computer programming. Questions asking us to recommend or find an editor are strictly off-topic. ',	1,	'2018-08-04 06:01:10'),
(68,	'Assembly',	'language/Assembly',	'Assembly language (asm) programming questions. BE SURE TO ALSO TAG with the processor and/or instruction set you\'re using, as well as the assembler. WARNING: For .NET assemblies, use the tag [.net-assembly] instead. For Java ASM, use the tag [java-bytecode-asm] instead.',	1,	'2018-08-04 06:05:18');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT 'default-user-image.png',
  `title` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `website` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `github` varchar(200) NOT NULL,
  `password` varchar(40) NOT NULL,
  `facebook` varchar(100) NOT NULL,
  `googleplus` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `voted` int(11) NOT NULL,
  `badgesGold` int(11) NOT NULL,
  `badgesSilver` int(11) NOT NULL,
  `badgesBronze` int(11) NOT NULL,
  `peopleReached` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  `badgesUpdateQ` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `badgesUpdateA` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `badgesUpdateP` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reputationUpdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=583 DEFAULT CHARSET=utf8;

TRUNCATE `users`;

DROP TABLE IF EXISTS `signupHashes`;
CREATE TABLE `signupHashes` (
  `userid` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  KEY `userid` (`userid`),
  CONSTRAINT `signupHashes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `signupHashes`;

DROP TABLE IF EXISTS `forgotHashes`;
CREATE TABLE `forgotHashes` (
  `userid` int(11) NOT NULL,
  `hash` varchar(40) NOT NULL,
  KEY `userid` (`userid`),
  CONSTRAINT `forgotHashes_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

TRUNCATE `forgotHashes`;

DROP TABLE IF EXISTS `reportSchema`;
CREATE TABLE `reportSchema` (
  `rsid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`rsid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

TRUNCATE `reportSchema`;
INSERT INTO `reportSchema` (`rsid`, `name`, `description`, `on`, `status`) VALUES
(1,	'Inappropriate',	'This is just inappropriate to me, that is why I m reporting it.',	'2018-07-24 07:30:49',	1),
(2,	'Invalid',	'This is just invalid.',	'2018-07-24 07:31:11',	1),
(3,	'Copyright',	'This has a copyrighted content.',	'2018-07-24 07:31:44',	1);


DROP TABLE IF EXISTS `reputationRecord`;
CREATE TABLE `reputationRecord` (
  `repId` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `reputation` int(11) NOT NULL,
  `on` date NOT NULL,
  PRIMARY KEY (`repId`),
  KEY `userid` (`userid`),
  CONSTRAINT `reputationRecord_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=576 DEFAULT CHARSET=latin1;


TRUNCATE `reputationRecord`;


DROP TABLE IF EXISTS `siteSettings`;
CREATE TABLE `siteSettings` (
  `siteName` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `logo` varchar(40) NOT NULL,
  `favicon` varchar(40) NOT NULL,
  `facebookLink` varchar(40) NOT NULL,
  `googleLink` varchar(40) NOT NULL,
  `twitterLink` varchar(200) NOT NULL,
  `dribbleLink` varchar(200) NOT NULL,
  `imgurClientId` varchar(200) NOT NULL,
  `bannerAd` text NOT NULL,
  `sidebarAd` text NOT NULL,
  `fbAppId` varchar(50) NOT NULL,
  `fbAppSecet` varchar(50) NOT NULL,
  `googleAppId` varchar(150) NOT NULL,
  `smtpUsername` varchar(200) NOT NULL,
  `smtpPassword` varchar(200) NOT NULL,
  `googleAppSecret` varchar(100) NOT NULL,
  `googleAnalyticsCode` text NOT NULL,
  `adminApproveQuestions` tinyint(1) NOT NULL,
  `bannerAdEnable` tinyint(4) NOT NULL,
  `sidebarAdEnable` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


TRUNCATE `siteSettings`;
INSERT INTO `siteSettings` (`siteName`, `tags`, `description`, `logo`, `favicon`, `facebookLink`, `googleLink`, `twitterLink`, `dribbleLink`, `imgurClientId`, `bannerAd`, `sidebarAd`, `fbAppId`, `fbAppSecet`, `googleAppId`, `smtpUsername`, `smtpPassword`, `googleAppSecret`, `googleAnalyticsCode`, `adminApproveQuestions`, `bannerAdEnable`, `sidebarAdEnable`) VALUES
('HowStack',	'question,tags,answers,comunity,find',	'&lt;p&gt;HowStack is is the largest, most trusted online community for developers to learn.&lt;/p&gt;',	'72f82e1e16c7df87ec529677752a9a63.png',	'd806184a2ee345c81dcf16f214b18e18.png',	'https://facebook.com/',	'https://googleplus.com',	'https://dribble.com',	'https://twiiter.com',	'',	'',	'',	'',	'',	'',	'',	'',	'',	'',	0,	0,	0);

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `catid` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `permalink` varchar(150) NOT NULL,
  `tags` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `votes` int(11) NOT NULL,
  `awnsers` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `onDate` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`qid`),
  KEY `userid` (`userid`),
  KEY `catid` (`catid`),
  CONSTRAINT `questions_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `questions_ibfk_4` FOREIGN KEY (`catid`) REFERENCES `categories` (`catid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9769 DEFAULT CHARSET=utf8;

TRUNCATE `questions`;


DROP TABLE IF EXISTS `editedQuestionsList`;
CREATE TABLE `editedQuestionsList` (
  `eqlId` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL,
  PRIMARY KEY (`eqlId`),
  KEY `qid` (`qid`),
  KEY `userid` (`userid`),
  CONSTRAINT `editedQuestionsList_ibfk_3` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `editedQuestionsList_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


TRUNCATE `editedQuestionsList`;

DROP TABLE IF EXISTS `questionSchema`;
CREATE TABLE `questionSchema` (
  `canVoteAfter` int(11) NOT NULL,
  `canReplyAfter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


TRUNCATE `questionSchema`;
INSERT INTO `questionSchema` (`canVoteAfter`, `canReplyAfter`) VALUES
(15,	50);

DROP TABLE IF EXISTS `questionsReplies`;
CREATE TABLE `questionsReplies` (
  `qrid` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `reply` text NOT NULL,
  `userid` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`qrid`),
  KEY `qid` (`qid`),
  KEY `userid` (`userid`),
  CONSTRAINT `questionsReplies_ibfk_3` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `questionsReplies_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

TRUNCATE `questionsReplies`;

DROP TABLE IF EXISTS `awnsers`;
CREATE TABLE `awnsers` (
  `qaid` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `description` text NOT NULL,
  `votes` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`qaid`),
  KEY `qid` (`qid`),
  KEY `userid` (`userid`),
  CONSTRAINT `awnsers_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `awnsers_ibfk_5` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

TRUNCATE `awnsers`;

DROP TABLE IF EXISTS `awnserReplies`;
CREATE TABLE `awnserReplies` (
  `arid` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `qaid` int(11) NOT NULL,
  `reply` text NOT NULL,
  `votes` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`arid`),
  KEY `qaid` (`qaid`),
  KEY `userid` (`userid`),
  KEY `qid` (`qid`),
  CONSTRAINT `awnserReplies_ibfk_4` FOREIGN KEY (`qaid`) REFERENCES `awnsers` (`qaid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `awnserReplies_ibfk_5` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `awnserReplies_ibfk_6` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

TRUNCATE `awnserReplies`;

DROP TABLE IF EXISTS `reportedAnswers`;
CREATE TABLE `reportedAnswers` (
  `ans` int(11) NOT NULL AUTO_INCREMENT,
  `qaid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `rsid` int(11) NOT NULL,
  `on` datetime NOT NULL,
  PRIMARY KEY (`ans`),
  KEY `qaid` (`qaid`),
  KEY `userid` (`userid`),
  KEY `rsid` (`rsid`),
  CONSTRAINT `reportedAnswers_ibfk_4` FOREIGN KEY (`qaid`) REFERENCES `awnsers` (`qaid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reportedAnswers_ibfk_5` FOREIGN KEY (`rsid`) REFERENCES `reportSchema` (`rsid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reportedAnswers_ibfk_6` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

TRUNCATE `reportedAnswers`;

DROP TABLE IF EXISTS `votedAnswers`;
CREATE TABLE `votedAnswers` (
  `voteAid` int(11) NOT NULL AUTO_INCREMENT,
  `qaid` int(11) NOT NULL,
  `val` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`voteAid`),
  KEY `qaid` (`qaid`),
  KEY `by` (`by`),
  CONSTRAINT `votedAnswers_ibfk_3` FOREIGN KEY (`qaid`) REFERENCES `awnsers` (`qaid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `votedAnswers_ibfk_4` FOREIGN KEY (`by`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

TRUNCATE `votedAnswers`;

DROP TABLE IF EXISTS `votedAReplies`;
CREATE TABLE `votedAReplies` (
  `votearid` int(11) NOT NULL AUTO_INCREMENT,
  `by` int(11) NOT NULL,
  `arid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`votearid`),
  KEY `by` (`by`),
  KEY `arid` (`arid`),
  CONSTRAINT `votedAReplies_ibfk_4` FOREIGN KEY (`arid`) REFERENCES `awnserReplies` (`arid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `votedAReplies_ibfk_5` FOREIGN KEY (`by`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `votedAReplies`;

DROP TABLE IF EXISTS `reportedReplies`;
CREATE TABLE `reportedReplies` (
  `reportRId` int(11) NOT NULL AUTO_INCREMENT,
  `qrid` int(11) DEFAULT NULL,
  `arid` int(11) DEFAULT NULL,
  `rsid` int(11) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reportRId`),
  KEY `qrid` (`qrid`),
  KEY `arid` (`arid`),
  KEY `userid` (`userid`),
  KEY `rsid` (`rsid`),
  CONSTRAINT `reportedReplies_ibfk_5` FOREIGN KEY (`qrid`) REFERENCES `questionsReplies` (`qrid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reportedReplies_ibfk_6` FOREIGN KEY (`rsid`) REFERENCES `reportSchema` (`rsid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reportedReplies_ibfk_7` FOREIGN KEY (`arid`) REFERENCES `awnserReplies` (`arid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reportedReplies_ibfk_8` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

TRUNCATE `reportedReplies`;

DROP TABLE IF EXISTS `votedQReplies`;
CREATE TABLE `votedQReplies` (
  `voteqrid` int(11) NOT NULL AUTO_INCREMENT,
  `qrid` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`voteqrid`),
  KEY `qrid` (`qrid`),
  KEY `by` (`by`),
  CONSTRAINT `votedQReplies_ibfk_1` FOREIGN KEY (`qrid`) REFERENCES `questionsReplies` (`qrid`) ON DELETE CASCADE,
  CONSTRAINT `votedQReplies_ibfk_2` FOREIGN KEY (`by`) REFERENCES `users` (`userid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `votedQReplies`;

DROP TABLE IF EXISTS `votedQuestions`;
CREATE TABLE `votedQuestions` (
  `voteQid` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `by` int(11) NOT NULL,
  `val` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`voteQid`),
  KEY `qid` (`qid`),
  KEY `by` (`by`),
  CONSTRAINT `votedQuestions_ibfk_3` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `votedQuestions_ibfk_4` FOREIGN KEY (`by`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `votedQuestions`;

DROP TABLE IF EXISTS `badges`;
CREATE TABLE `badges` (
  `badgeId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `priority` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`badgeId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;


TRUNCATE `badges`;
INSERT INTO `badges` (`badgeId`, `name`, `type`, `description`, `priority`, `value`, `on`) VALUES
(1,	'Favorite',	1,	'Question voted by <value> users ',	3,	25,	'2018-08-06 11:30:14'),
(2,	'Nice Question',	1,	'Question score of <value> or more ',	3,	10,	'2018-08-06 11:31:04'),
(3,	'Good Question',	1,	'Question score of <value> or more',	3,	25,	'2018-08-06 11:33:56'),
(4,	'Great Question',	1,	'Question score of <value> or more',	3,	100,	'2018-08-06 11:36:31'),
(5,	'Popular Question',	1,	'Question with <value> views',	1,	1000,	'2018-08-06 11:42:11'),
(6,	'Scholar',	1,	'Ask a question and accept an answer',	3,	0,	'2018-08-06 11:44:37'),
(7,	'Student',	1,	'First question with score of <value> or more',	3,	1,	'2018-08-06 11:45:01'),
(9,	'Guru',	2,	'Answer and score of <value> or more',	3,	40,	'2018-08-06 11:46:59'),
(10,	'Nice Answer',	2,	'Answer score of <value> or more',	3,	10,	'2018-08-06 11:48:28'),
(11,	'Good Answer',	2,	'Answer score of <value> or more ',	3,	25,	'2018-08-06 11:48:46'),
(12,	'Great Answer',	2,	'Answer score of <value> or more',	2,	100,	'2018-08-06 11:50:13'),
(13,	'Self-Learner',	2,	'Answer your own question with score of <value> or more',	3,	3,	'2018-08-06 11:50:35'),
(14,	'Teacher',	2,	'Answer a question with score of <value> or more ',	3,	1,	'2018-08-06 11:51:02'),
(15,	'Autobiographer',	3,	'Complete \"About Me\" section of user profile',	3,	0,	'2018-08-06 11:52:22'),
(16,	'Commentator',	3,	'Leave <value> comments',	3,	10,	'2018-08-06 11:52:41'),
(17,	'Pundit',	3,	'Leave <value> comments with score of 5 or more',	3,	5,	'2018-08-06 11:53:12'),
(19,	'Yearling',	3,	'Active member for a year, earning at least <value> reputation',	1,	200,	'2018-08-06 11:54:06');



DROP TABLE IF EXISTS `awardedBadges`;
CREATE TABLE `awardedBadges` (
  `awardId` int(11) NOT NULL AUTO_INCREMENT,
  `badgeId` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `awardId` (`awardId`),
  KEY `userid` (`userid`),
  KEY `badgeId` (`badgeId`),
  CONSTRAINT `awardedBadges_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `awardedBadges_ibfk_5` FOREIGN KEY (`badgeId`) REFERENCES `badges` (`badgeId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

TRUNCATE `awardedBadges`;

DROP TABLE IF EXISTS `notificationSchema`;
CREATE TABLE `notificationSchema` (
  `nsId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) NOT NULL,
  `description` varchar(100) NOT NULL,
  `permalink` varchar(100) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nsId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;


TRUNCATE `notificationSchema`;
INSERT INTO `notificationSchema` (`nsId`, `title`, `description`, `permalink`, `on`) VALUES
(1,	'Received an answer on your question',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:06:35'),
(2,	'Received a reply on your question',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:07:30'),
(3,	'Received a reply on your answer',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:07:58'),
(4,	'Your question was edited',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:13:48'),
(5,	'Your question was reported',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:14:12'),
(6,	'Your answer was reported',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:14:24'),
(7,	'Your answer reply was reported',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:14:56'),
(8,	'Your question reply was reported',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:15:17'),
(9,	'Your question reply was voted',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:15:33'),
(10,	'Your answer reply was reported',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:15:39'),
(11,	'Badge received',	'You received a badge (badgeName)',	'profile/(userid)',	'2018-08-28 07:16:56'),
(12,	'Reputation Change',	'You earned a reputation (reputation)',	'profile/(userid)',	'2018-08-28 07:17:58'),
(13,	'Your question was voted',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:40:04'),
(14,	'Your answer was voted',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:40:04'),
(15,	'Your answer reply was voted',	'(questionName)',	'questions/(questionId)/(questionPerma)',	'2018-08-28 07:14:56');


DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `nsId` int(11) NOT NULL,
  `for` int(11) NOT NULL,
  `by` int(11) DEFAULT NULL,
  `qid` int(11) DEFAULT NULL,
  `qaid` int(11) DEFAULT NULL,
  `qrid` int(11) DEFAULT NULL,
  `arid` int(11) DEFAULT NULL,
  `badgeId` int(11) DEFAULT NULL,
  `repId` int(11) DEFAULT NULL,
  `read` int(10) NOT NULL,
  `on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`),
  KEY `qid` (`qid`),
  KEY `qaid` (`qaid`),
  KEY `nsId` (`nsId`),
  KEY `qrid` (`qrid`),
  KEY `arid` (`arid`),
  KEY `badgeId` (`badgeId`),
  KEY `repId` (`repId`),
  CONSTRAINT `notifications_ibfk_10` FOREIGN KEY (`nsId`) REFERENCES `notificationSchema` (`nsId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notifications_ibfk_11` FOREIGN KEY (`arid`) REFERENCES `awnserReplies` (`arid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notifications_ibfk_12` FOREIGN KEY (`badgeId`) REFERENCES `badges` (`badgeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notifications_ibfk_13` FOREIGN KEY (`repId`) REFERENCES `reputationRecord` (`repId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notifications_ibfk_4` FOREIGN KEY (`qrid`) REFERENCES `questionsReplies` (`qrid`) ON DELETE CASCADE,
  CONSTRAINT `notifications_ibfk_8` FOREIGN KEY (`qid`) REFERENCES `questions` (`qid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `notifications_ibfk_9` FOREIGN KEY (`qaid`) REFERENCES `awnsers` (`qaid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

TRUNCATE `notifications`;

-- 2018-09-19 12:39:56
DROP TABLE IF EXISTS `Blog`;
CREATE TABLE `Blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_title` varchar(30) NOT NULL,
  `permalink` VARCHAR(100) NOT NULL,
  `blog_category` varchar(20) NOT NULL,
  `blog_date` date NOT NULL,
  `blog_description` mediumtext NOT NULL,
  `thumbnail` varchar(20) NOT NULL,
  `main_image` varchar(20) NOT NULL,
  `tags` varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `date` varchar(20) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Jobs` (
  `id` int(11) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `job_permalink` varchar(200) NOT NULL,
  `job_category` varchar(20) NOT NULL,
  `job_role` varchar(50) NOT NULL,
  `job_type` varchar(20) NOT NULL,
  `job_experience` varchar(20) NOT NULL,
  `technologies` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `salary` varchar(20) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `companylocation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;