<?php
	namespace Classes\Models;

	use \TCPDF;

	class TcpdfModels extends TCPDF{
		public static function gerarPDF()
		{
			// Criar instância
			$pdf = new TCPDF();
	
			// Remover cabeçalho e rodapé padrão
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
	
			// Adicionar página
			$pdf->AddPage();
	
			// Fonte
			$pdf->SetFont('helvetica', '', 12);
	
			// Texto básico
			$pdf->Write(0, 'Olá, mundo! TCPDF está funcionando.', '', 0, 'L', true, 0, false, false, 0);
	
			// Mostrar PDF no navegador
			$pdf->Output('teste_tcpdf.pdf', 'I');
		}

		public static function exportarTabelaPDF($header, $data, $filename = 'tabela') {
			// Criar instância com orientação paisagem ('L')
			$pdf = new TCPDF('L', 'mm', 'A4');

			// Remover cabeçalho e rodapé padrão
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);

			// Adicionar página
			$pdf->AddPage();

			// Fonte padrão
			$pdf->SetFont('helvetica', '', 12);

			// Adicionar título
			$pdf->SetFont('helvetica', 'B', 14);
			$pdf->Cell(0, 10, 'Exportação de ' . strtoupper($filename), 0, 1, 'C');
			$pdf->Ln(5);

			// Calcular largura dinâmica das células
			$pageWidth = $pdf->getPageWidth() - PDF_MARGIN_LEFT - PDF_MARGIN_RIGHT; // Largura da página sem margens
			$cellWidth = $pageWidth / count($header); // Largura de cada célula com base no número de colunas

			// Configurar cabeçalho da tabela
			$pdf->SetFont('helvetica', 'B', 12);
			$pdf->SetFillColor(43, 125, 237); // Cor de fundo do cabeçalho (azul claro)
			$pdf->SetTextColor(255, 255, 255); // Cor do texto do cabeçalho (branco)
			foreach ($header as $col) {
				$pdf->MultiCell($cellWidth, 10, $col, 1, 'C', 1, 0); // Alinhamento centralizado
			}
			$pdf->Ln();

			// Configurar dados da tabela
			$pdf->SetFont('helvetica', '', 10);
			$pdf->SetFillColor(240, 240, 240); // Cor de fundo das células (cinza muito claro)
			$pdf->SetTextColor(50, 50, 50); // Cor do texto das células (cinza escuro)
			$fill = 0; // Alternar preenchimento
			foreach ($data as $row) {
				foreach ($row as $cell) {
					$pdf->MultiCell($cellWidth, 10, $cell, 1, 'C', $fill, 0); // Alinhamento centralizado com quebra de linha
				}
				$pdf->Ln();
				$fill = !$fill; // Alterna a cor de preenchimento para criar um efeito de listras
			}

			// Adicionar rodapé com data e hora
			$pdf->Ln(10);
			$pdf->SetFont('helvetica', 'I', 8);
			$pdf->SetTextColor(100, 100, 100);
			$pdf->Cell(0, 10, 'Gerado em: ' . date('d/m/Y H:i:s'), 0, 0, 'R');

			// Mostrar PDF no navegador
			$datetime = date('d-m-Y_H-i-s');
			$pdf->Output($filename . '_' . $datetime . '.pdf', 'I');
		}
    }
?>