USE [Inventario]
GO

/****** Object:  Table [dbo].[tb_escalonamento]    Script Date: 25/06/2019 20:34:15 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[tb_escalonamento](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[operadora] [varchar](80) NOT NULL,
	[sigla] [varchar](5) NULL,
	[nivel] [varchar](10) NULL,
	[contato] [varchar](200) NULL,
	[funcao] [varchar](100) NULL,
	[telefone] [varchar](14) NULL,
	[opcao] [varchar](50) NULL,
	[celular1] [varchar](50) NULL,
	[celular2] [varchar](50) NULL,
	[email] [varchar](100) NULL,
	[hor_atend] [varchar](100) NULL,
	[tpa] [varchar](100) NULL,
	[hc] [varchar](100) NULL,
	[ot] [varchar](50) NULL,
	[obs] [text] NULL,
	[user_alt] [varchar](20) NULL,
	[niv_min] [varchar](50) NULL,
	[coml] [varchar](150) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO


