<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EduPath</title>
  <link rel="stylesheet" href="/css/home.css">
</head>
<body>

<div class="container">
  <!-- Header -->
  <?php include ROOT_DIR.'views/components/header.php'; ?>*
  
  <!-- Main content -->
  <main>
    <!-- Hero Section -->
    <section class="hero">
      <h1>Votre voyage vers la connaissance commence ici</h1>
      <p>Découvrez des milliers de cours d'instructeurs experts du monde entier.</p>
      <form class="search-form">
        <input type="search" placeholder="Rechercher des cours...">
        <button type="submit">Rechercher</button>
      </form>
      <div class="hero-buttons">
        <a href="#" class="btn-primary">Parcourir les cours</a>
        <a href="#" class="btn-outline">Commencer à enseigner</a>
      </div>
    </section>

    <!-- Featured Courses Section -->
    <section class="courses">
      <h2 class="section-title">Cours en vedette</h2>
      <div class="course-list">
        <?php for ($i = 1; $i <= 3; $i++): ?>
        <div class="course-card">
          <img src="/courseThumbnail.png" alt="Vignette du cours" class="course-thumbnail">
          <span class="badge">Meilleure vente</span>
          <h3>Cours complet de développement web</h3>
          <div class="course-info">
            <div class="tuteur">            
              <img src="user.png" alt="Instructeur" class="avatar">
              <span>John Smith</span>
            </div>

            <span class="rating">⭐ 4.8 (2.5k avis)</span>
          </div>
          <div class="course-footer">
            <span class="price">89,99 €</span>
            <a href="#" class="btn-primary">En savoir plus</a>
          </div>
        </div>
        <?php endfor; ?>
      </div>
    </section>

    <!-- How it Works Section -->
    <section class="how-it-works">
      <h2 class="section-title">Comment ça marche</h2>
      <div class="steps">
        <div class="step">
          <div class="icon">🎓</div>
          <h3>S'inscrire</h3>
          <p>Créez votre compte et configurez votre profil en quelques minutes.</p>
        </div>
        <div class="step">
          <div class="icon">📚</div>
          <h3>Trouver des cours</h3>
          <p>Parcourez notre vaste bibliothèque de cours de qualité.</p>
        </div>
        <div class="step">
          <div class="icon">🏆</div>
          <h3>Commencer à apprendre</h3>
          <p>Apprenez à votre rythme et obtenez des certificats.</p>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
      <h2 class="section-title">Ce que disent nos étudiants</h2>
      <div class="testimonial-list">
        <?php for ($i = 1; $i <= 3; $i++): ?>
        <div class="testimonial-card">
          <div class="testimonial-header">
            <div class="nameImageRole">            
              <img src="user.png" alt="Étudiant" class="avatar2">
              <div class="testimonial-name">
                <h3>Sarah Johnson</h3>
                <p>Étudiante en développement web</p>
              </div>
            </div>

          </div>
          <p>"Les cours sur CheminÉdu m'ont aidée à faire une transition vers une nouvelle carrière. Les instructeurs sont compétents et le contenu est de premier ordre."</p>
        </div>
        <?php endfor; ?>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="footer-content">
      <div class="footer-section">
        <h4>À propos</h4>
        <ul>
          <li><a href="#">Qui sommes-nous ?</a></li>
          <li><a href="#">Notre histoire</a></li>
          <li><a href="#">Pourquoi Edupath ?</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h4>Support</h4>
        <ul>
          <li><a href="#">Contactez-nous</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Reclamation</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h4>Produits</h4>
        <ul>
          <li><a href="#">Quiz</a></li>
          <li><a href="#">Cours</a></li>
          <li><a href="#">Forum</a></li>
        </ul>
      </div>
      <div class="footer-section">
        <h4>Newsletter</h4>
        <form>
          <input type="email" placeholder="Entrez votre email">
          <button type="submit">S'abonner</button>
        </form>
      </div>
    </div>
    <p>© 2024 Edupath. Tous droits réservés.</p>
  </footer>
</div>

</body>
</html>
