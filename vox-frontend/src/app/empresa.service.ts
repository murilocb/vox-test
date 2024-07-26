import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class EmpresaService {
  private apiUrl = 'http://localhost:8000/empresas';

  constructor(private http: HttpClient) {}

  getEmpresas(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }

  getEmpresa(id: number): Observable<any> {
    return this.http.get<any>(`${this.apiUrl}/${id}`);
  }

  createEmpresa(empresa: any): Observable<any> {
    return this.http.post<any>(this.apiUrl, empresa);
  }

  updateEmpresa(id: number, empresa: any): Observable<any> {
    return this.http.put<any>(`${this.apiUrl}/${id}`, empresa);
  }

  deleteEmpresa(id: number): Observable<any> {
    return this.http.delete<any>(`${this.apiUrl}/${id}`);
  }
}
