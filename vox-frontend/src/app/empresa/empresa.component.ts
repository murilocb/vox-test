import { Component, OnInit } from '@angular/core';
import { EmpresaService } from '../empresa.service';

@Component({
  selector: 'app-empresa',
  templateUrl: './empresa.component.html',
  styleUrls: ['./empresa.component.css'],
})
export class EmpresaComponent implements OnInit {
  empresas: any[] = [];

  constructor(private empresaService: EmpresaService) {}

  ngOnInit(): void {
    this.empresaService.getEmpresas().subscribe({
      next: (data) => {
        this.empresas = data;
      },
      error: (err) => {
        console.error('Erro ao carregar empresas', err);
      },
    });
  }
}
