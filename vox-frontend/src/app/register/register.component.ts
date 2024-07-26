import { Component } from '@angular/core';
import { AuthService } from '../auth.service';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { MatCardModule } from '@angular/material/card';
import { MatLabel } from '@angular/material/form-field';

@Component({
  selector: 'app-register',
  standalone: true,
  imports: [FormsModule, ReactiveFormsModule, MatCardModule, MatLabel],
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
})
export class RegisterComponent {
  email: string = '';
  password: string = '';
  confirmPassword: string = '';

  constructor(private authService: AuthService) {}

  onRegister(): void {
    if (this.password !== this.confirmPassword) {
      alert('As senhas não coincidem.');
      return;
    }
    this.authService.register(this.email, this.password).subscribe({
      next: () => {},
      error: (err) => {
        console.error('Erro ao registrar usuário', err);
      },
    });
  }
}
