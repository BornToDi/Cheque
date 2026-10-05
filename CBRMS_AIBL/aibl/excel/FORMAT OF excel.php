
uses
  ComObj;

var
  ExcelApp: OleVariant;

implementation


procedure TForm1.Button1Click(Sender: TObject);
const
  // SheetType
  xlChart = -4109;
  xlWorksheet = -4167;
  // WBATemplate
  xlWBATWorksheet = -4167;
  xlWBATChart = -4109;
  // Page Setup
  xlPortrait = 1;
  xlLandscape = 2;
  xlPaperA4 = 9;
  // Format Cells
  xlBottom = -4107;
  xlLeft = -4131;
  xlRight = -4152;
  xlTop = -4160;
  // Text Alignment
  xlHAlignCenter = -4108;
  xlVAlignCenter = -4108;
  // Cell Borders
  xlThick = 4;
  xlThin = 2;
var
  ColumnRange: OleVariant;

  // Function to get the number of Rows in a Certain column

  function GetLastLine(AColumn: Integer): Integer;
  const
    xlUp = 3;
  begin
    Result := ExcelApp.Range[Char(96 + AColumn) + IntToStr(65536)].end[xlUp].Rows.Row;
  end;

begin
  { Start Excel }

  // By using GetActiveOleObject, you use an instance of Word that's already running,
  // if there is one.
  try
    ExcelApp := GetActiveOleObject('Excel.Application');
  except
    try
      // If no instance of Word is running, try to Create a new Excel Object
      ExcelApp := CreateOleObject('Excel.Application');
    except
      ShowMessage('Cannot start Excel/Excel not installed ?');
      Exit;
    end;
  end;

  // Add a new Workbook, Neue Arbeitsmappe öffnen
  ExcelApp.Workbooks.Add(xlWBatWorkSheet);

  // Open a Workbook, Arbeitsmappe öffnen
  ExcelApp.Workbooks.Open('c:\YourFileName.xls');


  // Rename the active Sheet
  ExcelApp.ActiveSheet.Name := 'This is Sheet 1';

  // Rename
  ExcelApp.Workbooks[1].WorkSheets[1].Name := 'This is Sheet 1';

  // Insert some Text in some Cells[Row,Col]
  ExcelApp.Cells[1, 1].Value := 'SwissDelphiCenter.ch';
  ExcelApp.Cells[2, 1].Value := 'http://www.swissdelphicenter.ch';
  ExcelApp.Cells[3, 1].Value := FormatDateTime('dd-mmm-yyyy', Now);

  // Setting a row of data with one call
  ExcelApp.Range['A2', 'D2'].Value := VarArrayOf([1, 10, 100, 1000]);

  // Setting a formula
  ExcelApp.Range['A11', 'A11'].Formula := '=Sum(A1:A10)';

  // Change Cell Alignement
  ExcelApp.Cells[2, 1].HorizontalAlignment := xlright;

  // Change the Column Width.
  ColumnRange := ExcelApp.Workbooks[1].WorkSheets[1].Columns;
  ColumnRange.Columns[1].ColumnWidth := 20;
  ColumnRange.Columns[2].ColumnWidth := 40;

  // Change Rowheight / Zeilenhöhe ändern:
  ExcelApp.Rows[1].RowHeight := 15.75;

  // Merge cells, Zellen verbinden:
  ExcelApp.Range['B3:D3'].Mergecells := True;

  // Apply borders to cells, Zellen umrahmen:
  ExcelApp.Range['A14:M14'].Borders.Weight := xlThick; // Think line/ Dicke Linie
  ExcelApp.Range['A14:M14'].Borders.Weight := xlThin;  // Thin line Dünne Linie

  // Set Bold Font in cells, Fettdruck in den Zellen

  ExcelApp.Range['B16:M26'].Font.Bold := True;

  // Set Font Size, Schriftgröße setzen
  ExcelApp.Range['B16:M26'].Font.Size := 12;

  //right-aligned Text, rechtsbündige Textausrichtung
  ExcelApp.Cells[9, 6].HorizontalAlignment := xlright;

  // horizontal-aligned text, horizontale Zentrierung
  ExcelApp.Range['B14:M26'].HorizontalAlignment := xlHAlignCenter;

  // left-aligned Text, vertikale Zentrierung
  ExcelApp.Range['B14:M26'].VerticallyAlignment := xlVAlignCenter;


  { Page Setup }

  ExcelApp.ActiveSheet.PageSetup.Orientation := xlLandscape;

  // Left, Right Margin (Seitenränder)
  ExcelApp.ActiveSheet.PageSetup.LeftMargin  := 35;
  ExcelApp.ActiveSheet.PageSetup.RightMargin := -15;

  // Set Footer Margin
  ExcelApp.ActiveSheet.PageSetup.FooterMargin := ExcelApp.InchesToPoints(0);

  // Fit to X page(s) wide by Y tall
  ExcelApp.ActiveSheet.PageSetup.FitToPagesWide := 1;  // Y
  ExcelApp.ActiveSheet.PageSetup.FitToPagesTall := 3; // Y

  // Zoom
  ExcelApp.ActiveSheet.PageSetup.Zoom := 95;

  // Set Paper Size:
  ExcelApp.PageSetup.PaperSize := xlPaperA4;

  // Show/Hide Gridlines:
  ExcelApp.ActiveWindow.DisplayGridlines := False;

  // Set Black & White
  ExcelApp.ActiveSheet.PageSetup.BlackAndWhite := False;

  // footers
  ExcelApp.ActiveSheet.PageSetup.RightFooter := 'Right Footer / Rechte Fußzeile';
  ExcelApp.ActiveSheet.PageSetup.LeftFooter  := 'Left Footer / Linke Fußzeile';

  // Show Excel Version:
  ShowMessage(Format('Excel Version %s: ', [ExcelApp.Version]));

  // Show Excel:
  ExcelApp.Visible := True;

  // Save the Workbook
  ExcelApp.SaveAs('c:\filename.xls');

  // Save the active Workbook:
  ExcelApp.ActiveWorkBook.SaveAs('c:\filename.xls');

end;

procedure TForm1.FormDestroy(Sender: TObject);
begin
  // Quit Excel
  if not VarIsEmpty(ExcelApp) then
  begin
    ExcelApp.DisplayAlerts := False;  // Discard unsaved files....
    ExcelApp.Quit;
  end;
end;