import { Component, OnInit } from '@angular/core';
import { SocioService } from '../socio.service';

@Component({
  selector: 'app-socio',
  templateUrl: './socio.component.html',
  styleUrls: ['./socio.component.css'],
})
export class SocioComponent implements OnInit {
  socios: any[] = [];

  constructor(private socioService: SocioService) {}

  ngOnInit(): void {
    this.socioService.getSocios().subscribe({
      next: (data) => {
        this.socios = data;
      },
      error: (err) => {
        console.error('Erro ao carregar sócios', err);
      },
    });
  }
}
