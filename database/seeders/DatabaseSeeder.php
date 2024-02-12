<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feedback;
use App\Models\Dog;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Dog::create([
            'name' => 'Tinker',
            'description' => 'Juega mucho con sus juguetes',
            'image' => 'https://c.files.bbci.co.uk/48DD/production/_107435681_perro1.jpg',
            'stars' => 5,
            'breed' => 'pug'
        ]);

        Dog::create([
            'name' => 'Kiker',
            'description' => 'Perro de raza labrador, 3 años de edad, color café, muy juguetón y cariñoso.',
            'image' => 'https://static.fundacion-affinity.org/cdn/farfuture/PVbbIC-0M9y4fPbbCsdvAD8bcjjtbFc0NSP3lRwlWcE/mtime:1643275542/sites/default/files/los-10-sonidos-principales-del-perro.jpg',
            'stars' => 5,
            'breed' => 'labrador'
        ]);

        Dog::create([
            'name' => 'Frank',
            'description' => 'Es un perro muy tierno, apenas tiene 6 meses de nacido.',
            'image' => 'https://media.traveler.es/photos/613760adcb06ad0f20e11980/master/w_1600%2Cc_limit/202931.jpg',
            'stars' => 5,
            'breed' => 'rottweiler'
        ]);

        Dog::create([
            'name' => 'Jack',
            'description' => 'Perro protector, cuida muy bien, le encanta correr y hacer actividades al aire libre',
            'image' => 'https://s1.eestatic.com/2022/04/19/curiosidades/mascotas/666193753_223665685_1706x960.jpg',
            'stars' => 5,
            'breed' => 'aleman'
        ]);

        Dog::create([
            'name' => 'Laika',
            'description' => 'Una preciosa huski, le encanta aullar y correr, muy hiperactiva por cierto',
            'image' => 'https://as01.epimg.net/diarioas/imagenes/2022/05/29/actualidad/1653826510_995351_1653826595_noticia_normal_recorte1.jpg',
            'stars' => 5,
            'breed' => 'huski'
        ]);

        Dog::create([
            'name' => 'Daphne',
            'description' => 'Muy tranquila, le encanta comer y tiene muchos amigos',
            'image' => 'https://cvfaunia.com/wp-content/uploads/2020/11/123004876_3609155692482412_2049794398247296546_n.jpg',
            'stars' => 5,
            'breed' => 'pomeriana'
        ]);

        Dog::create([
            'name' => 'Bombón',
            'description' => 'Perrita suave y esponjosa, le encanta correr y jugar con más perros',
            'image' => 'https://www.cuerpomente.com/medio/2023/06/08/perro-en-un-prado_bc5b1a31_230608141116_1280x720.jpg',
            'stars' => 5,
            'breed' => 'pomeriana'
        ]);

        Feedback::create([
            'name' => 'John',
            'comment' => 'Excelente servicio, mi máscota solo espera el día en que lo cuiden',
            'photo' => 'https://img.freepik.com/foto-gratis/retrato-hombre-blanco-aislado_53876-40306.jpg?size=626&ext=jpg&ga=GA1.1.1803636316.1707609600&semt=ais',
        ]);

        Feedback::create([
            'name' => 'Miguel',
            'comment' => 'Muy buenos cuidados, mi perro siempre regresa feliz',
            'photo' => 'https://img.freepik.com/fotos-premium/retrato-hombre-negocios-expresion-cara-seria-fondo-estudio-espacio-copia-bengala-persona-corporativa-enfoque-pensamiento-duda-mirada-facial-dilema-o-concentracion_590464-84924.jpg'
        ]);

        Feedback::create([
            'name' => 'Tatiana',
            'comment' => 'La mejor empresa en cuidado de mascotas, siempre los recomiendo',
            'photo' => 'https://estaticos-cdn.prensaiberica.es/clip/958630c2-98d1-4b52-bbc1-79f84d8a07ca_16-9-aspect-ratio_default_0.jpg'
        ]);
        
        Feedback::create([
            'name' => 'Alex',
            'comment' => 'Agradecido de que exista, no sé qué haría sin elos cuando tengo que salir a trabajar, mi máscota se aburriría',
            'photo' => 'https://img.freepik.com/foto-gratis/concepto-emociones-personas-foto-cabeza-hombre-guapo-aspecto-serio-barba-confiado-decidido_1258-26730.jpg'
        ]);

        Feedback::create([
            'name' => 'Luis',
            'comment' => 'Lo mejor en cuidado de mascotas, recomendado',
            'photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTV1OaBc6dMQDEAQkgnu8f3JVaiSQSs_Ibh2w&usqp=CAU'
        ]);
    }
}
