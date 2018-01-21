USE [master]
GO
/****** Object:  Database [aurum]    Script Date: 22/01/2018 2:29:13 AM ******/
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
/****** Object:  Table [dbo].[accounts]    Script Date: 22/01/2018 2:29:14 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[accounts](
	[accountID] [int] IDENTITY(1,1) NOT NULL,
	[accountUsername] [varchar](150) NOT NULL,
	[accountPassword] [varchar](120) NOT NULL,
	[accountPhoto] [varbinary](max) NULL,
	[accountFN] [varchar](150) NOT NULL,
	[accountMN] [varchar](100) NULL,
	[accountLN] [varchar](150) NOT NULL,
	[accountBirthDate] [date] NULL,
	[accountSex] [char](2) NULL,
	[accountSSSNo] [nvarchar](130) NOT NULL,
	[accountTINNo] [nvarchar](130) NOT NULL,
	[accountBIRNo] [nvarchar](130) NOT NULL,
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
/****** Object:  Table [dbo].[addresses]    Script Date: 22/01/2018 2:29:14 AM ******/
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
/****** Object:  Table [dbo].[civilstatuses]    Script Date: 22/01/2018 2:29:14 AM ******/
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
/****** Object:  Table [dbo].[contacts]    Script Date: 22/01/2018 2:29:14 AM ******/
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
/****** Object:  Table [dbo].[contacttypes]    Script Date: 22/01/2018 2:29:14 AM ******/
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
/****** Object:  Table [dbo].[departments]    Script Date: 22/01/2018 2:29:14 AM ******/
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
/****** Object:  Table [dbo].[positions]    Script Date: 22/01/2018 2:29:14 AM ******/
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
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Foreign key that connects the accounts table and the civilstatuses table. Defines the civil status of the user/account.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'accounts', @level2type=N'CONSTRAINT',@level2name=N'FK_accounts_civilstatuses'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Connects the departments table to the accounts table.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'accounts', @level2type=N'CONSTRAINT',@level2name=N'FK_accounts_departments'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Foreign key that connects the accounts table and the positions table. Defines the account owner''s position in the company as well as the access privileges that they have.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'accounts', @level2type=N'CONSTRAINT',@level2name=N'FK_accounts_positions'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Connects the addresses table and accounts table. Gives the address record an owner(account).' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'addresses', @level2type=N'CONSTRAINT',@level2name=N'FK_addresses_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Connects the contacts table to the accounts table. Gives a record an owner account.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'contacts', @level2type=N'CONSTRAINT',@level2name=N'FK_contacts_accounts'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Connects the contacts table and the contacttypes table.' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'contacts', @level2type=N'CONSTRAINT',@level2name=N'FK_contacts_contacttypes'
GO
USE [master]
GO
ALTER DATABASE [aurum] SET  READ_WRITE 
GO
