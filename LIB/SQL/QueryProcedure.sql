USE [REPORT]
GO

DECLARE	@return_value int

EXEC	@return_value = [dbo].[procListaCircuitos]
		@fil = NULL,
		@sr = NULL,
		@uni = NULL,
		@ope = NULL,
		@con = NULL,
		@tip = NULL,
		@des = NULL,
		@bkb = NULL

SELECT	'Return Value' = @return_value

GO
