import { Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { EmpresaComponent } from './empresa/empresa.component';
import { SocioComponent } from './socio/socio.component';
import { RegisterComponent } from './register/register.component';

export const routes: Routes = [
  { path: 'login', component: LoginComponent },
  { path: 'register', component: RegisterComponent },
  { path: 'empresas', component: EmpresaComponent },
  { path: 'socios', component: SocioComponent },
  { path: '', redirectTo: '/login', pathMatch: 'full' },
];
