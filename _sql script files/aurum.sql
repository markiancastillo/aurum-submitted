USE [master]
GO
/****** Object:  Database [aurum]    Script Date: 06/03/2018 1:39:08 AM ******/
CREATE DATABASE [aurum]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'aurum', FILENAME = N'D:\Program Files\Microsoft SQL Server\MSSQL13.MSSQLSERVER\MSSQL\DATA\aurum.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'aurum_log', FILENAME = N'D:\Program Files\Microsoft SQL Server\MSSQL13.MSSQLSERVER\MSSQL\DATA\aurum_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
GO
ALTER DATABASE [aurum] SET COMPATIBILITY_LEVEL = 130
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [aurum].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [aurum] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [aurum] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [aurum] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [aurum] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [aurum] SET ARITHABORT OFF 
GO
ALTER DATABASE [aurum] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [aurum] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [aurum] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [aurum] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [aurum] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [aurum] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [aurum] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [aurum] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [aurum] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [aurum] SET  DISABLE_BROKER 
GO
ALTER DATABASE [aurum] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [aurum] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [aurum] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [aurum] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [aurum] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [aurum] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [aurum] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [aurum] SET RECOVERY FULL 
GO
ALTER DATABASE [aurum] SET  MULTI_USER 
GO
ALTER DATABASE [aurum] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [aurum] SET DB_CHAINING OFF 
GO
ALTER DATABASE [aurum] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [aurum] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [aurum] SET DELAYED_DURABILITY = DISABLED 
GO
EXEC sys.sp_db_vardecimal_storage_format N'aurum', N'ON'
GO
ALTER DATABASE [aurum] SET QUERY_STORE = OFF
GO
USE [aurum]
GO
ALTER DATABASE SCOPED CONFIGURATION SET LEGACY_CARDINALITY_ESTIMATION = OFF;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET LEGACY_CARDINALITY_ESTIMATION = PRIMARY;
GO
ALTER DATABASE SCOPED CONFIGURATION SET MAXDOP = 0;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET MAXDOP = PRIMARY;
GO
ALTER DATABASE SCOPED CONFIGURATION SET PARAMETER_SNIFFING = ON;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET PARAMETER_SNIFFING = PRIMARY;
GO
ALTER DATABASE SCOPED CONFIGURATION SET QUERY_OPTIMIZER_HOTFIXES = OFF;
GO
ALTER DATABASE SCOPED CONFIGURATION FOR SECONDARY SET QUERY_OPTIMIZER_HOTFIXES = PRIMARY;
GO
USE [aurum]
GO
/****** Object:  Table [dbo].[accounts]    Script Date: 06/03/2018 1:39:09 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[accounts](
	[accountID] [int] IDENTITY(1,1) NOT NULL,
	[accountUsername] [varchar](150) NOT NULL,
	[accountPassword] [varchar](120) NOT NULL,
	[accountPhoto] [nvarchar](max) NULL,
	[accountFN] [varchar](150) NOT NULL,
	[accountMN] [varchar](100) NULL,
	[accountLN] [varchar](150) NOT NULL,
	[accountBirthDate] [date] NULL,
	[accountSex] [char](2) NULL,
	[accountSSSNo] [nvarchar](130) NOT NULL,
	[accountTINNo] [nvarchar](130) NOT NULL,
	[accountHDMFNo] [nvarchar](130) NOT NULL,
	[accountEmail] [varchar](100) NULL,
	[accountBaseRate] [decimal](10, 2) NOT NULL,
	[accountStatus] [varchar](30) NOT NULL,
	[cstatusID] [int] NOT NULL,
	[positionID] [int] NOT NULL,
	[departmentID] [int] NOT NULL,
 CONSTRAINT [PK_accounts] PRIMARY KEY CLUSTERED 
(
	[accountID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[addresses]    Script Date: 06/03/2018 1:39:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[addresses](
	[addressID] [int] IDENTITY(1,1) NOT NULL,
	[addressL1] [varchar](150) NULL,
	[addressL2] [varchar](150) NULL,
	[addressCity] [varchar](100) NULL,
	[addressZip] [char](10) NULL,
	[accountID] [int] NOT NULL,
 CONSTRAINT [PK_addresses] PRIMARY KEY CLUSTERED 
(
	[addressID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[attendances]    Script Date: 06/03/2018 1:39:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[attendances](
	[attendanceID] [int] IDENTITY(1,1) NOT NULL,
	[attendanceIn] [time](7) NOT NULL,
	[attendanceOut] [time](7) NOT NULL,
	[attendanceDate] [date] NOT NULL,
	[attendanceRemarks] [varchar](150) NULL,
	[accountID] [int] NOT NULL,
 CONSTRAINT [PK_attendances] PRIMARY KEY CLUSTERED 
(
	[attendanceID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cases]    Script Date: 06/03/2018 1:39:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[cases](
	[caseID] [int] IDENTITY(1,1) NOT NULL,
	[caseTitle] [varchar](200) NOT NULL,
	[caseDescription] [varchar](200) NULL,
	[caseStartDate] [date] NOT NULL,
	[caseEndDate] [date] NOT NULL,
	[caseRemarks] [varchar](200) NULL,
	[caseStatus] [varchar](50) NOT NULL,
	[accountID] [int] NOT NULL,
	[clientID] [int] NOT NULL,
 CONSTRAINT [PK_cases] PRIMARY KEY CLUSTERED 
(
	[caseID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[civilstatuses]    Script Date: 06/03/2018 1:39:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[civilstatuses](
	[cstatusID] [int] IDENTITY(1,1) NOT NULL,
	[cstatusName] [varchar](50) NOT NULL,
	[cstatusDescription] [varchar](200) NULL,
 CONSTRAINT [PK_civilstatuses] PRIMARY KEY CLUSTERED 
(
	[cstatusID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[clients]    Script Date: 06/03/2018 1:39:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[clients](
	[clientID] [int] IDENTITY(1,1) NOT NULL,
	[clientPhoto] [nvarchar](max) NULL,
	[clientFN] [varchar](150) NOT NULL,
	[clientMN] [varchar](100) NULL,
	[clientLN] [varchar](150) NOT NULL,
	[clientEmail] [varchar](150) NULL,
 CONSTRAINT [PK_clients] PRIMARY KEY CLUSTERED 
(
	[clientID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[contacts]    Script Date: 06/03/2018 1:39:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[contacts](
	[contactID] [int] IDENTITY(1,1) NOT NULL,
	[contactNumber] [nvarchar](max) NOT NULL,
	[ctypeID] [int] NOT NULL,
	[accountID] [int] NOT NULL,
 CONSTRAINT [PK_contacts] PRIMARY KEY CLUSTERED 
(
	[contactID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[contacttypes]    Script Date: 06/03/2018 1:39:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[contacttypes](
	[ctypeID] [int] IDENTITY(1,1) NOT NULL,
	[ctypeName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_contacttypes] PRIMARY KEY CLUSTERED 
(
	[ctypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[departments]    Script Date: 06/03/2018 1:39:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[departments](
	[departmentID] [int] IDENTITY(1,1) NOT NULL,
	[departmentName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_departments] PRIMARY KEY CLUSTERED 
(
	[departmentID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[expenses]    Script Date: 06/03/2018 1:39:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[expenses](
	[expenseID] [int] IDENTITY(1,1) NOT NULL,
	[expenseAmount] [decimal](10, 2) NOT NULL,
	[expenseDate] [date] NOT NULL,
	[expenseProof] [nvarchar](max) NULL,
	[expenseRemarks] [varchar](150) NULL,
	[expenseStatus] [varchar](30) NOT NULL,
	[expenseReviewedBy] [int] NULL,
	[expenseNote] [varchar](150) NULL,
	[etypeID] [int] NOT NULL,
	[accountID] [int] NOT NULL,
	[caseID] [int] NOT NULL,
 CONSTRAINT [PK_expenses] PRIMARY KEY CLUSTERED 
(
	[expenseID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[expensetypes]    Script Date: 06/03/2018 1:39:18 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[expensetypes](
	[etypeID] [int] IDENTITY(1,1) NOT NULL,
	[etypeName] [varchar](120) NOT NULL,
	[etypeDescription] [varchar](200) NULL,
 CONSTRAINT [PK_expensetypes] PRIMARY KEY CLUSTERED 
(
	[etypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[leavecounts]    Script Date: 06/03/2018 1:39:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[leavecounts](
	[lcID] [int] IDENTITY(1,1) NOT NULL,
	[lcAmount] [int] NOT NULL,
	[accountID] [int] NOT NULL,
	[ltypeID] [int] NOT NULL,
 CONSTRAINT [PK_leavecounts] PRIMARY KEY CLUSTERED 
(
	[lcID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[leaves]    Script Date: 06/03/2018 1:39:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[leaves](
	[leaveID] [int] IDENTITY(1,1) NOT NULL,
	[leaveFileDate] [datetime] NOT NULL,
	[leaveFrom] [date] NOT NULL,
	[leaveTo] [date] NOT NULL,
	[leaveReason] [varchar](200) NOT NULL,
	[leaveStatus] [varchar](50) NOT NULL,
	[leaveReviewedBy] [int] NULL,
	[leaveRemarks] [varchar](200) NULL,
	[accountID] [int] NULL,
	[ltypeID] [int] NULL,
 CONSTRAINT [PK_leaves] PRIMARY KEY CLUSTERED 
(
	[leaveID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[leavetypes]    Script Date: 06/03/2018 1:39:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[leavetypes](
	[ltypeID] [int] IDENTITY(1,1) NOT NULL,
	[ltypeName] [varchar](120) NULL,
	[ltypeDescription] [varchar](200) NOT NULL,
 CONSTRAINT [PK_leavetypes] PRIMARY KEY CLUSTERED 
(
	[ltypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[logs]    Script Date: 06/03/2018 1:39:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[logs](
	[logID] [int] IDENTITY(1,1) NOT NULL,
	[logAccount] [int] NOT NULL,
	[logEvent] [varchar](max) NOT NULL,
	[logDate] [datetime] NOT NULL,
 CONSTRAINT [PK_logs] PRIMARY KEY CLUSTERED 
(
	[logID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[notifications]    Script Date: 06/03/2018 1:39:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[notifications](
	[notificationID] [int] IDENTITY(1,1) NOT NULL,
	[notificationMessage] [varchar](255) NOT NULL,
	[notificationDate] [datetime] NOT NULL,
	[notificationStatus] [varchar](50) NOT NULL,
	[accountID] [int] NOT NULL,
 CONSTRAINT [PK_notifications] PRIMARY KEY CLUSTERED 
(
	[notificationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[positions]    Script Date: 06/03/2018 1:39:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[positions](
	[positionID] [int] IDENTITY(1,1) NOT NULL,
	[positionName] [varchar](50) NOT NULL,
	[positionDescription] [varchar](200) NULL,
 CONSTRAINT [PK_positions] PRIMARY KEY CLUSTERED 
(
	[positionID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[receipts]    Script Date: 06/03/2018 1:39:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[receipts](
	[receiptID] [int] IDENTITY(1,1) NOT NULL,
	[receiptFIle] [nvarchar](max) NOT NULL,
	[receiptDate] [datetime] NOT NULL,
	[receiptRemarks] [varchar](150) NULL,
	[receiptStatus] [varchar](50) NULL,
	[accountID] [int] NOT NULL,
 CONSTRAINT [PK_receipts] PRIMARY KEY CLUSTERED 
(
	[receiptID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[servicefees]    Script Date: 06/03/2018 1:39:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[servicefees](
	[sfID] [int] IDENTITY(1,1) NOT NULL,
	[sfAmount] [decimal](10, 2) NOT NULL,
	[sfDate] [date] NOT NULL,
	[sfProof] [nvarchar](max) NULL,
	[sfRemarks] [varchar](150) NULL,
	[sfStatus] [varchar](30) NOT NULL,
	[sfReviewedBy] [int] NULL,
	[sfNote] [varchar](150) NULL,
	[stypeID] [int] NOT NULL,
	[accountID] [int] NOT NULL,
	[caseID] [int] NOT NULL,
 CONSTRAINT [PK_servicefees] PRIMARY KEY CLUSTERED 
(
	[sfID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[servicetypes]    Script Date: 06/03/2018 1:39:19 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[servicetypes](
	[stypeID] [int] IDENTITY(1,1) NOT NULL,
	[stypeName] [varchar](120) NOT NULL,
	[stypeDescription] [varchar](200) NULL,
 CONSTRAINT [PK_servicetypes] PRIMARY KEY CLUSTERED 
(
	[stypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[accounts]  WITH CHECK ADD  CONSTRAINT [FK_accounts_civilstatuses] FOREIGN KEY([cstatusID])
REFERENCES [dbo].[civilstatuses] ([cstatusID])
GO
ALTER TABLE [dbo].[accounts] CHECK CONSTRAINT [FK_accounts_civilstatuses]
GO
ALTER TABLE [dbo].[accounts]  WITH CHECK ADD  CONSTRAINT [FK_accounts_departments] FOREIGN KEY([departmentID])
REFERENCES [dbo].[departments] ([departmentID])
GO
ALTER TABLE [dbo].[accounts] CHECK CONSTRAINT [FK_accounts_departments]
GO
ALTER TABLE [dbo].[accounts]  WITH CHECK ADD  CONSTRAINT [FK_accounts_positions] FOREIGN KEY([positionID])
REFERENCES [dbo].[positions] ([positionID])
GO
ALTER TABLE [dbo].[accounts] CHECK CONSTRAINT [FK_accounts_positions]
GO
ALTER TABLE [dbo].[addresses]  WITH CHECK ADD  CONSTRAINT [FK_addresses_accounts] FOREIGN KEY([accountID])
REFERENCES [dbo].[accounts] ([accountID])
GO
ALTER TABLE [dbo].[addresses] CHECK CONSTRAINT [FK_addresses_accounts]
GO
ALTER TABLE [dbo].[attendances]  WITH CHECK ADD  CONSTRAINT [FK_attendances_accounts] FOREIGN KEY([accountID])
REFERENCES [dbo].[accounts] ([accountID])
GO
ALTER TABLE [dbo].[attendances] CHECK CONSTRAINT [FK_attendances_accounts]
GO
ALTER TABLE [dbo].[cases]  WITH CHECK ADD  CONSTRAINT [FK_cases_accounts] FOREIGN KEY([accountID])
REFERENCES [dbo].[accounts] ([accountID])
GO
ALTER TABLE [dbo].[cases] CHECK CONSTRAINT [FK_cases_accounts]
GO
ALTER TABLE [dbo].[cases]  WITH CHECK ADD  CONSTRAINT [FK_cases_clients] FOREIGN KEY([clientID])
REFERENCES [dbo].[clients] ([clientID])
GO
ALTER TABLE [dbo].[cases] CHECK CONSTRAINT [FK_cases_clients]
GO
ALTER TABLE [dbo].[contacts]  WITH CHECK ADD  CONSTRAINT [FK_contacts_accounts] FOREIGN KEY([accountID])
REFERENCES [dbo].[accounts] ([accountID])
GO
ALTER TABLE [dbo].[contacts] CHECK CONSTRAINT [FK_contacts_accounts]
GO
ALTER TABLE [dbo].[contacts]  WITH CHECK ADD  CONSTRAINT [FK_contacts_contacttypes] FOREIGN KEY([ctypeID])
REFERENCES [dbo].[contacttypes] ([ctypeID])
GO
ALTER TABLE [dbo].[contacts] CHECK CONSTRAINT [FK_contacts_contacttypes]
GO
ALTER TABLE [dbo].[expenses]  WITH CHECK ADD  CONSTRAINT [FK_expenses_accounts] FOREIGN KEY([accountID])
REFERENCES [dbo].[accounts] ([accountID])
GO
ALTER TABLE [dbo].[expenses] CHECK CONSTRAINT [FK_expenses_accounts]
GO
ALTER TABLE [dbo].[expenses]  WITH CHECK ADD  CONSTRAINT [FK_expenses_cases] FOREIGN KEY([caseID])
REFERENCES [dbo].[cases] ([caseID])
GO
ALTER TABLE [dbo].[expenses] CHECK CONSTRAINT [FK_expenses_cases]
GO
ALTER TABLE [dbo].[expenses]  WITH CHECK ADD  CONSTRAINT [FK_expenses_expensetypes] FOREIGN KEY([etypeID])
REFERENCES [dbo].[expensetypes] ([etypeID])
GO
ALTER TABLE [dbo].[expenses] CHECK CONSTRAINT [FK_expenses_expensetypes]
GO
ALTER TABLE [dbo].[leavecounts]  WITH CHECK ADD  CONSTRAINT [FK_leavecounts_accounts] FOREIGN KEY([accountID])
REFERENCES [dbo].[accounts] ([accountID])
GO
ALTER TABLE [dbo].[leavecounts] CHECK CONSTRAINT [FK_leavecounts_accounts]
GO
ALTER TABLE [dbo].[leavecounts]  WITH CHECK ADD  CONSTRAINT [FK_leavecounts_leavetypes] FOREIGN KEY([ltypeID])
REFERENCES [dbo].[leavetypes] ([ltypeID])
GO
ALTER TABLE [dbo].[leavecounts] CHECK CONSTRAINT [FK_leavecounts_leavetypes]
GO
ALTER TABLE [dbo].[leaves]  WITH CHECK ADD  CONSTRAINT [FK_leaves_accounts] FOREIGN KEY([accountID])
REFERENCES [dbo].[accounts] ([accountID])
GO
ALTER TABLE [dbo].[leaves] CHECK CONSTRAINT [FK_leaves_accounts]
GO
ALTER TABLE [dbo].[leaves]  WITH CHECK ADD  CONSTRAINT [FK_leaves_leavetypes] FOREIGN KEY([ltypeID])
REFERENCES [dbo].[leavetypes] ([ltypeID])
GO
ALTER TABLE [dbo].[leaves] CHECK CONSTRAINT [FK_leaves_leavetypes]
GO
ALTER TABLE [dbo].[notifications]  WITH CHECK ADD  CONSTRAINT [FK_notifications_accounts] FOREIGN KEY([accountID])
REFERENCES [dbo].[accounts] ([accountID])
GO
ALTER TABLE [dbo].[notifications] CHECK CONSTRAINT [FK_notifications_accounts]
GO
ALTER TABLE [dbo].[receipts]  WITH CHECK ADD  CONSTRAINT [FK_receipts_accounts] FOREIGN KEY([accountID])
REFERENCES [dbo].[accounts] ([accountID])
GO
ALTER TABLE [dbo].[receipts] CHECK CONSTRAINT [FK_receipts_accounts]
GO
ALTER TABLE [dbo].[servicefees]  WITH CHECK ADD  CONSTRAINT [FK_servicefees_accounts] FOREIGN KEY([accountID])
REFERENCES [dbo].[accounts] ([accountID])
GO
ALTER TABLE [dbo].[servicefees] CHECK CONSTRAINT [FK_servicefees_accounts]
GO
ALTER TABLE [dbo].[servicefees]  WITH CHECK ADD  CONSTRAINT [FK_servicefees_cases] FOREIGN KEY([caseID])
REFERENCES [dbo].[cases] ([caseID])
GO
ALTER TABLE [dbo].[servicefees] CHECK CONSTRAINT [FK_servicefees_cases]
GO
ALTER TABLE [dbo].[servicefees]  WITH CHECK ADD  CONSTRAINT [FK_servicefees_servicetypes] FOREIGN KEY([stypeID])
REFERENCES [dbo].[servicetypes] ([stypeID])
GO
ALTER TABLE [dbo].[servicefees] CHECK CONSTRAINT [FK_servicefees_servicetypes]
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Foreign key that connects the accounts table and the civilstatuses table. Defines the civil status of the user/account.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'accounts', @level2type=N'CONSTRAINT',@level2name=N'FK_accounts_civilstatuses'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Connects the departments table to the accounts table.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'accounts', @level2type=N'CONSTRAINT',@level2name=N'FK_accounts_departments'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Foreign key that connects the accounts table and the positions table. Defines the account owner''s position in the company as well as the access privileges that they have.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'accounts', @level2type=N'CONSTRAINT',@level2name=N'FK_accounts_positions'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Connects the addresses table and accounts table. Gives the address record an owner(account).' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'addresses', @level2type=N'CONSTRAINT',@level2name=N'FK_addresses_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Defines the account that owns the record.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'attendances', @level2type=N'CONSTRAINT',@level2name=N'FK_attendances_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Specifies the account involved with the case' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cases', @level2type=N'CONSTRAINT',@level2name=N'FK_cases_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Specifies which client the case is for.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'cases', @level2type=N'CONSTRAINT',@level2name=N'FK_cases_clients'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Connects the contacts table to the accounts table. Gives a record an owner account.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'contacts', @level2type=N'CONSTRAINT',@level2name=N'FK_contacts_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Connects the contacts table and the contacttypes table.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'contacts', @level2type=N'CONSTRAINT',@level2name=N'FK_contacts_contacttypes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Connects the expenses and accounts table. Specifies who incurred which account.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'expenses', @level2type=N'CONSTRAINT',@level2name=N'FK_expenses_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Connects the expenses to the expensetypes table. Relates what type of expense the record is.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'expenses', @level2type=N'CONSTRAINT',@level2name=N'FK_expenses_expensetypes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Specifies the owner of the record.
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'leavecounts', @level2type=N'CONSTRAINT',@level2name=N'FK_leavecounts_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Specifies the type of leave filed.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'leavecounts', @level2type=N'CONSTRAINT',@level2name=N'FK_leavecounts_leavetypes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Determines the account which requested the leave.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'leaves', @level2type=N'CONSTRAINT',@level2name=N'FK_leaves_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Determines the type of leave for the record.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'leaves', @level2type=N'CONSTRAINT',@level2name=N'FK_leaves_leavetypes'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Determines the owner of the record.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'notifications', @level2type=N'CONSTRAINT',@level2name=N'FK_notifications_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Specifies the account that owns the record
' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'receipts', @level2type=N'CONSTRAINT',@level2name=N'FK_receipts_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Specifies the account that rendered the service.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'servicefees', @level2type=N'CONSTRAINT',@level2name=N'FK_servicefees_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Specifies which case the service was rendered for.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'servicefees', @level2type=N'CONSTRAINT',@level2name=N'FK_servicefees_cases'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Specifies the type of service rendered on the record.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'servicefees', @level2type=N'CONSTRAINT',@level2name=N'FK_servicefees_servicetypes'
GO
USE [master]
GO
ALTER DATABASE [aurum] SET  READ_WRITE 
GO
