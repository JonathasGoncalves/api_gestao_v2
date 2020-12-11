<?php

namespace App\Exports;
use App\Models\Cooperado;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Resources\RelatorioQualidadeExport;
use Maatwebsite\Excel\Concerns\FromCollection;

class QualidadeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($data_referencia, $relatorio, $filtro, $padrao)
    {
        $this->relatorio = $relatorio;
        $this->filtro = $filtro;
        $this->padrao = $padrao;
        $this->data_referencia = $data_referencia;
        $this->cooperado = new Cooperado();
    }

   

    public function collection()
    {
        return RelatorioQualidadeExport::collection($this->cooperado->relatorio_qualidade($this->data_referencia, $this->relatorio, $this->filtro, $this->padrao));

    }

    public function headingRow(): int
    {
        return 2;
    }
     

    public function headings(): array
    {
        return [
            'NOME',
            'CODIGO',
            'MUNICIPIO',
            'TANQUE',
            'LATÃO',
            'CBT',
            'CCS',
        ];
    }
}
