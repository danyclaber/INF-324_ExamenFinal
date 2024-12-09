using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace delimitacionDesiertosFormAplication
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void MostrarRangoDeColores()
        {
            // Crear un Bitmap para representar el rango de colores
            Bitmap rangoColores = new Bitmap(256, 50); // Ancho y alto del rango

            // Definir los rangos de colores
            int minR = 150, maxR = 255;
            int minG = 100, maxG = 200;
            int minB = 50, maxB = 150;

            for (int x = 0; x < rangoColores.Width; x++)
            {
                for (int y = 0; y < rangoColores.Height; y++)
                {
                    // Escalar los valores de R, G y B a lo largo del ancho del PictureBox
                    int r = minR + (x * (maxR - minR) / rangoColores.Width);
                    int g = minG + (x * (maxG - minG) / rangoColores.Width);
                    int b = minB + (x * (maxB - minB) / rangoColores.Width);

                    // Aplicar el color al píxel
                    rangoColores.SetPixel(x, y, Color.FromArgb(r, g, b));
                }
            }

            // Mostrar el rango de colores en un PictureBox adicional
            pictureBox3.Image = rangoColores;
        }



        private void button1_Click(object sender, EventArgs e)
        {
            // Configuración del filtro para archivos de imagen
            OpenFileDialog openFileDialog = new OpenFileDialog();
            openFileDialog.Filter = "Imagenes PNG|*.png|Imagenes JPG|*.jpg|Todos los archivos|*.*";

            // Mostrar el cuadro de diálogo para seleccionar un archivo
            if (openFileDialog.ShowDialog() == DialogResult.OK)
            {
                try
                {
                    // Cargar la imagen seleccionada en el PictureBox
                    Bitmap imagenCargada = new Bitmap(openFileDialog.FileName);
                    pictureBox1.Image = imagenCargada;
                }
                catch (Exception ex)
                {
                    // Manejar errores en caso de que no se pueda cargar la imagen
                    MessageBox.Show("Error al cargar la imagen: " + ex.Message, "Error", MessageBoxButtons.OK, MessageBoxIcon.Error);
                }
            }
        }

      
        private void button2_Click(object sender, EventArgs e)
        {
            Bitmap original = new Bitmap(pictureBox1.Image); // Imagen original cargada
            Bitmap procesada = new Bitmap(original.Width, original.Height); // Imagen de salida

            // Definir los rangos de colores para áreas desérticas
            int minR = 150, maxR = 255;
            int minG = 100, maxG = 200;
            int minB = 50, maxB = 150;

            for (int i = 0; i < original.Width; i++)
            {
                for (int j = 0; j < original.Height; j++)
                {
                    // Obtener el color del píxel actual
                    Color pixel = original.GetPixel(i, j);

                    // Verificar si el píxel está dentro del rango de colores desérticos
                    if (pixel.R >= minR && pixel.R <= maxR &&
                        pixel.G >= minG && pixel.G <= maxG &&
                        pixel.B >= minB && pixel.B <= maxB)
                    {
                        // Marcar como área desértica (ej. en rojo)
                        procesada.SetPixel(i, j, Color.Red);
                    }
                    else
                    {
                        // Mantener el color original
                        procesada.SetPixel(i, j, pixel);
                    }
                }
            }

            // Mostrar la imagen procesada en un PictureBox
            pictureBox2.Image = procesada;
        }

        private void button3_Click(object sender, EventArgs e)
        {
            pictureBox2.Image = null; // Borra la imagen procesada
            pictureBox1.Image = null; // Borra la imagen original
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            MostrarRangoDeColores();
        }

        private void pictureBox2_Click(object sender, EventArgs e)
        {

        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        

    }
}
