-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 29, 2024 at 05:14 AM
-- Server version: 5.7.44
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_online_discussion_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `forum_name` varchar(255) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `slug`, `forum_name`, `description`, `created_at`) VALUES
(6, 'general-discussion', 'General Discussion', 'This forum is for general discussions on various topics.', '2024-04-27 06:02:35'),
(7, 'technical-support', 'Technical Support', 'Get help with technical issues and troubleshooting here.', '2024-04-27 06:02:35'),
(8, 'programming', 'Programming', 'Discuss programming languages, algorithms, and software development techniques.', '2024-04-27 06:02:35'),
(9, 'web-development', 'Web Development', 'Explore web development technologies such as HTML, CSS, and JavaScript.', '2024-04-27 06:02:35'),
(10, 'design', 'Design', 'Share ideas and resources for graphic design, UI/UX design, and digital art.', '2024-04-27 06:02:35'),
(11, 'music', 'Music', 'Talk about your favorite bands, albums, and genres of music.', '2024-04-27 06:02:35'),
(12, 'movies', 'Movies', 'Discuss the latest movies, film industry news, and movie reviews.', '2024-04-27 06:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `status` enum('pending','accepted','rejected') DEFAULT 'pending',
  `sent_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `sender_id`, `receiver_id`, `status`, `sent_at`) VALUES
(1, 13, 14, 'pending', '2024-04-28 10:14:00'),
(2, 14, 13, 'pending', '2024-04-28 10:14:00'),
(3, 2, 12, 'pending', '2024-04-28 10:14:00'),
(4, 12, 2, 'accepted', '2024-04-28 10:14:00'),
(5, 1, 15, 'accepted', '2024-04-28 10:14:00'),
(6, 15, 1, 'accepted', '2024-04-28 10:14:00'),
(7, 16, 2, 'accepted', '2024-04-28 10:14:00'),
(8, 17, 1, 'accepted', '2024-04-28 10:14:00'),
(9, 18, 2, 'accepted', '2024-04-28 10:14:00'),
(10, 1, 19, 'rejected', '2024-04-28 10:14:00'),
(11, 1, 16, 'rejected', '2024-04-28 10:14:00'),
(12, 2, 17, 'rejected', '2024-04-28 10:14:00'),
(13, 12, 18, 'rejected', '2024-04-28 10:14:00'),
(14, 13, 19, 'rejected', '2024-04-28 10:14:00'),
(15, 14, 15, 'rejected', '2024-04-28 10:14:00'),
(16, 15, 16, 'pending', '2024-04-28 10:14:30'),
(17, 16, 17, 'pending', '2024-04-28 10:14:30'),
(18, 17, 18, 'accepted', '2024-04-28 10:14:30'),
(19, 18, 19, 'accepted', '2024-04-28 10:14:30'),
(20, 19, 13, 'pending', '2024-04-28 10:14:30'),
(21, 2, 13, 'accepted', '2024-04-28 10:14:30'),
(22, 12, 14, 'accepted', '2024-04-28 10:14:30'),
(23, 13, 15, 'accepted', '2024-04-28 10:14:30'),
(24, 14, 16, 'accepted', '2024-04-28 10:14:30'),
(25, 15, 17, 'accepted', '2024-04-28 10:14:30'),
(26, 16, 18, 'rejected', '2024-04-28 10:14:30'),
(27, 17, 19, 'rejected', '2024-04-28 10:14:30'),
(28, 18, 13, 'rejected', '2024-04-28 10:14:30'),
(29, 19, 14, 'rejected', '2024-04-28 10:14:30'),
(30, 13, 12, 'rejected', '2024-04-28 10:14:30'),
(31, 19, 12, 'pending', '2024-04-28 11:16:52'),
(32, 19, 2, 'accepted', '2024-04-28 11:17:29');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `created_by`, `created_at`) VALUES
(1, 'Group E', 14, '2024-04-28 11:56:43'),
(2, 'Group C', 12, '2024-04-28 11:56:43'),
(12, 'Group D', 13, '2024-04-28 11:56:43'),
(13, 'Group A', 1, '2024-04-28 11:56:43'),
(14, 'Group B', 2, '2024-04-28 11:56:43'),
(15, 'Group F', 15, '2024-04-28 11:56:43'),
(16, 'Group G', 16, '2024-04-28 11:56:43'),
(17, 'Group H', 17, '2024-04-28 11:56:43'),
(18, 'Group I', 18, '2024-04-28 11:56:43'),
(19, 'Group J', 19, '2024-04-28 11:56:43'),
(20, 'asdfsdf', 2, '2024-04-28 12:17:17'),
(21, 'Koolpals', 2, '2024-04-28 12:17:22');

-- --------------------------------------------------------

--
-- Table structure for table `group_memberships`
--

CREATE TABLE `group_memberships` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `joined_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `invitation_status` enum('pending','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_memberships`
--

INSERT INTO `group_memberships` (`id`, `group_id`, `user_id`, `joined_at`, `invitation_status`) VALUES
(1, 13, 1, '2024-04-28 11:57:33', 'accepted'),
(2, 14, 2, '2024-04-28 11:57:33', 'accepted'),
(3, 2, 2, '2024-04-28 11:57:33', 'pending'),
(4, 12, 12, '2024-04-28 11:57:33', 'pending'),
(5, 1, 1, '2024-04-28 11:57:33', 'accepted'),
(6, 15, 15, '2024-04-28 11:57:33', 'accepted'),
(7, 16, 16, '2024-04-28 11:57:33', 'accepted'),
(8, 17, 17, '2024-04-28 11:57:33', 'accepted'),
(9, 18, 18, '2024-04-28 11:57:33', 'accepted'),
(10, 19, 19, '2024-04-28 11:57:33', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `forum_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `excerpt` text,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `post_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `posts_status` set('published','pending_approval','archived','deleted') NOT NULL DEFAULT 'pending_approval'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `forum_id`, `content`, `excerpt`, `featured`, `post_date`, `posts_status`) VALUES
(1, 1, 'Tips for Effective Time Management', 6, 'Share your tips and strategies for managing time efficiently and increasing productivity in daily life.', 'Effective time management strategies.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(2, 2, 'Introduction to Cybersecurity', 7, 'Learn about the fundamentals of cybersecurity, including threats, vulnerabilities, and best practices for securing digital assets.', 'Getting started with cybersecurity.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(3, 1, 'Exploring Functional Programming Paradigm', 8, 'Understand the concepts of functional programming and its benefits in software development. Explore languages like Haskell and Clojure.', 'Introduction to functional programming.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(4, 2, 'Creating Interactive Web Applications with React', 9, 'Discover the power of React.js in building interactive and dynamic web applications. Learn about components, state management, and more.', 'Building web apps with React.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(5, 1, 'UI/UX Design Principles for Mobile Apps', 10, 'Explore UI/UX design principles tailored for mobile applications. Learn how to create intuitive and visually appealing mobile interfaces.', 'Designing mobile app UI/UX.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(6, 2, 'Exploring World Music Cultures', 11, 'Dive into the diverse world of music cultures from around the globe. Explore traditional instruments, rhythms, and melodies from different regions.', 'Discover world music.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(7, 1, 'Review: Independent Film Gems', 12, 'Review and discuss lesser-known independent films that deserve recognition for their unique storytelling and artistic vision.', 'Discover indie film gems.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(8, 2, 'Advanced Data Visualization Techniques', 8, 'Explore advanced techniques for data visualization using tools like D3.js and Tableau. Learn how to create interactive and insightful visualizations.', 'Mastering data visualization.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(9, 1, 'Best Practices for Cross-Browser Testing', 9, 'Learn essential techniques for conducting cross-browser testing to ensure compatibility and consistency across different web browsers.', 'Cross-browser testing strategies.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(10, 2, 'Creating Memorable Brand Identities', 10, 'Discover the process of creating impactful brand identities through effective logo design, color schemes, and brand messaging.', 'Crafting brand identities.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(11, 1, 'Exploring Electronic Dance Music (EDM)', 11, 'Dive into the world of electronic dance music (EDM) and explore subgenres like house, trance, and dubstep. Discuss popular DJs, festivals, and tracks.', 'Discover EDM subgenres.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(12, 2, 'Review: Cult Classic Movies', 12, 'Review and discuss cult classic movies that have gained a dedicated following over the years. Share your favorite cult films and why they resonate with you.', 'Discuss cult classic films.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(13, 1, 'Introduction to Natural Language Processing (NLP)', 8, 'Explore the field of natural language processing (NLP) and its applications in text analysis, sentiment analysis, and language translation.', 'Getting started with NLP.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(14, 2, 'Mastering Responsive Web Design', 9, 'Learn advanced techniques for creating responsive web designs that adapt seamlessly to various screen sizes and devices.', 'Responsive web design mastery.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(15, 1, 'Digital Painting Techniques', 10, 'Discover digital painting techniques using software like Adobe Photoshop and Corel Painter. Learn how to create digital artworks with depth and realism.', 'Mastering digital painting.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(16, 2, 'Exploring World Cinema', 11, 'Explore the rich tapestry of world cinema, from acclaimed directors to iconic films from different countries and cultures.', 'Discover world cinema.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(17, 1, 'Review: Hidden Gem TV Shows', 12, 'Review and discuss underrated TV shows that deserve more recognition for their compelling storytelling, characters, and themes.', 'Discover hidden gem TV shows.', 0, '2024-04-28 07:10:55', 'pending_approval'),
(18, 1, 'The Benefits of Meditation', 6, 'Discover the numerous benefits of meditation for mental health and overall well-being. Learn different meditation techniques to incorporate into your daily routine.', 'Unlock the power of meditation.', 0, '2024-04-28 07:12:15', 'published'),
(19, 2, 'Cybersecurity Best Practices for Remote Work', 7, 'Learn essential cybersecurity best practices to secure remote work environments. From VPNs to secure passwords, ensure your remote setup is protected.', 'Secure your remote work setup.', 0, '2024-04-28 07:12:15', 'published'),
(20, 1, 'Exploring Functional Programming with Haskell', 8, 'Dive deep into the functional programming paradigm with Haskell. Explore pure functions, lazy evaluation, and the type system that makes Haskell unique.', 'Discover Haskell programming.', 0, '2024-04-28 07:12:15', 'published'),
(21, 2, 'Building Modern E-Commerce Websites with React', 9, 'Explore how React can revolutionize the way you build e-commerce websites. From dynamic product listings to seamless checkout experiences, leverage React for success.', 'Elevate your e-commerce with React.', 0, '2024-04-28 07:12:15', 'published'),
(22, 1, 'The Psychology of Color in Design', 10, 'Uncover the psychological effects of color in design and how it influences user perception and behavior. Learn how to use color strategically to evoke emotions and convey messages.', 'Harness the power of color psychology.', 0, '2024-04-28 07:12:15', 'published'),
(23, 2, 'Exploring Traditional Music Instruments', 11, 'Journey through the world of traditional music instruments from different cultures. Explore the history, craftsmanship, and significance of these timeless creations.', 'Discover traditional music instruments.', 0, '2024-04-28 07:12:15', 'published'),
(24, 1, 'A Tribute to Independent Filmmakers', 12, 'Celebrate the creativity and passion of independent filmmakers who challenge conventions and push boundaries in storytelling. Discover indie films that redefine cinema.', 'Explore indie filmmaking.', 0, '2024-04-28 07:12:15', 'published'),
(25, 2, 'Advanced Data Analysis Techniques with Python', 8, 'Unlock the full potential of data analysis with Python. Explore advanced techniques for data visualization, machine learning, and statistical analysis.', 'Master data analysis with Python.', 0, '2024-04-28 07:12:15', 'published'),
(26, 1, 'Effective Cross-Browser Testing Strategies', 9, 'Ensure seamless user experiences across all browsers with effective cross-browser testing strategies. From compatibility testing to responsive design checks, cover all bases.', 'Optimize your cross-browser testing.', 0, '2024-04-28 07:12:15', 'published'),
(27, 2, 'Crafting Memorable Brand Identities', 10, 'Learn the art of brand identity design and create lasting impressions with your brand. From logo design to brand messaging, craft a cohesive identity that resonates.', 'Build a strong brand identity.', 0, '2024-04-28 07:12:15', 'published'),
(28, 1, 'The Evolution of Jazz Music', 11, 'Trace the evolution of jazz music through its rich history. From its roots in African rhythms to its influence on modern genres, explore the journey of jazz.', 'Journey through jazz history.', 0, '2024-04-28 07:12:15', 'published'),
(29, 2, 'Review: Cult Classic TV Shows', 12, 'Revisit iconic cult classic TV shows that have left a lasting legacy in pop culture. From sci-fi epics to quirky comedies, relive the magic of these beloved series.', 'Rediscover cult classic TV shows.', 0, '2024-04-28 07:12:15', 'published'),
(30, 1, 'Introduction to Machine Learning Algorithms', 8, 'Get started with machine learning algorithms and understand their applications in various domains. From linear regression to neural networks, explore the fundamentals.', 'Embark on your ML journey.', 0, '2024-04-28 07:12:15', 'published'),
(31, 2, 'Optimizing Website Performance with Webpack', 9, 'Boost your website\'s performance with Webpack optimization techniques. From bundling assets to code splitting, optimize every aspect for a lightning-fast experience.', 'Supercharge your website with Webpack.', 0, '2024-04-28 07:12:15', 'published'),
(32, 1, 'Creating Digital Art with Procreate', 10, 'Unleash your creativity with Procreate and learn how to create stunning digital artworks from scratch. From sketching to painting, discover endless possibilities.', 'Master digital art with Procreate.', 0, '2024-04-28 07:12:15', 'published'),
(33, 2, 'Exploring Global Film Movements', 11, 'Dive into the diverse world of global film movements and their impact on cinema. From French New Wave to Italian Neorealism, explore cinematic revolutions.', 'Discover global film movements.', 0, '2024-04-28 07:12:15', 'published'),
(34, 1, 'Review: Underrated Indie Games', 12, 'Discover hidden gems in the world of indie games that deserve recognition for their innovative gameplay and artistic merit. Support indie developers and explore unique gaming experiences.', 'Uncover indie gaming treasures.', 0, '2024-04-28 07:12:15', 'published'),
(35, 1, 'The Power of Positive Thinking', 6, 'Discover how positive thinking can transform your life and lead to greater success and happiness. Explore practical tips for cultivating a positive mindset.', 'Unlock the power of positivity.', 1, '2024-04-28 07:16:55', 'published'),
(36, 2, 'Securing Your Online Privacy: A Comprehensive Guide', 7, 'Protect your online privacy and secure your personal data with this comprehensive guide. Learn essential tips for staying safe in the digital world.', 'Keep your online data safe.', 1, '2024-04-28 07:16:55', 'published'),
(37, 1, 'Mastering Functional Programming with Scala', 8, 'Dive into functional programming paradigms with Scala and unlock the full potential of functional programming concepts. Learn how to write elegant and concise code.', 'Scala for functional programming.', 1, '2024-04-28 07:16:55', 'published'),
(38, 2, 'Building Scalable Web Applications with Node.js', 9, 'Explore the power of Node.js in building scalable and efficient web applications. From real-time chat apps to streaming platforms, leverage Node.js for success.', 'Scale your apps with Node.js.', 1, '2024-04-28 07:16:55', 'published'),
(39, 1, 'The Art of Minimalist Design', 10, 'Learn the principles of minimalist design and how to create clean, elegant interfaces that prioritize usability and simplicity. Discover the beauty of less.', 'Simplify your designs.', 1, '2024-04-28 07:16:55', 'published'),
(40, 2, 'Exploring World Music: Traditional Instruments Edition', 11, 'Embark on a musical journey around the world and explore traditional instruments from different cultures. From the sitar to the djembe, discover the sounds of the globe.', 'Discover traditional music instruments.', 1, '2024-04-28 07:16:55', 'published'),
(41, 1, 'Indie Filmmaking: Breaking Barriers and Redefining Cinema', 12, 'Celebrate the creativity and innovation of indie filmmakers who challenge the norms and redefine the art of storytelling. Explore indie films that push boundaries.', 'Explore indie filmmaking.', 1, '2024-04-28 07:16:55', 'published'),
(42, 2, 'Advanced Data Analysis with Pandas and NumPy', 8, 'Take your data analysis skills to the next level with Pandas and NumPy. Learn advanced techniques for data manipulation, exploration, and visualization.', 'Master data analysis with Python.', 1, '2024-04-28 07:16:55', 'published'),
(43, 1, 'Optimizing User Experience: A Guide for Web Developers', 9, 'Deliver exceptional user experiences with this comprehensive guide for web developers. From responsive design to performance optimization, elevate your websites.', 'Enhance user experiences.', 1, '2024-04-28 07:16:55', 'published'),
(44, 2, 'Branding Beyond Borders: Crafting Global Brand Identities', 10, 'Expand your brand\'s reach and resonance with a global audience through strategic brand identity design. Learn how to create culturally relevant and impactful brand identities.', 'Craft global brand identities.', 1, '2024-04-28 07:16:55', 'published'),
(45, 1, 'The Influence of Jazz: From Counterculture to Mainstream', 11, 'Explore the enduring influence of jazz music on culture, art, and society. From its roots in African American communities to its global impact, trace jazz\'s journey.', 'Trace jazz influence.', 1, '2024-04-28 07:16:55', 'published'),
(46, 2, 'Classic Films Revisited: Iconic Movies That Stand the Test of Time', 12, 'Rediscover timeless classics that continue to captivate audiences across generations. From Casablanca to Citizen Kane, revisit the golden age of cinema.', 'Rediscover classic films.', 1, '2024-04-28 07:16:55', 'published'),
(47, 1, 'Introduction to Deep Learning with TensorFlow', 8, 'Dive into the world of deep learning with TensorFlow and unlock the potential of neural networks. Learn how to build and train deep learning models for various applications.', 'Get started with TensorFlow.', 1, '2024-04-28 07:16:55', 'published'),
(48, 2, 'Scaling Your Startup: Strategies for Growth and Success', 9, 'Navigate the challenges of scaling your startup with these proven strategies for sustainable growth and success. From hiring to fundraising, chart a path to expansion.', 'Scale your startup.', 1, '2024-04-28 07:16:55', 'published'),
(49, 1, 'The Art of Digital Illustration: From Concept to Creation', 10, 'Explore the creative process of digital illustration and learn how to bring your ideas to life with digital tools and techniques. From sketching to rendering, unleash your imagination.', 'Master digital illustration.', 1, '2024-04-28 07:16:55', 'published'),
(50, 2, 'World Cinema Showcase: Spotlight on International Filmmakers', 11, 'Celebrate the diversity and richness of world cinema with this curated showcase of films from around the globe. From Bollywood to French New Wave, discover cinematic treasures.', 'Explore world cinema.', 1, '2024-04-28 07:16:55', 'published'),
(51, 1, 'Indie Game Revolution: Exploring the Rise of Independent Gaming', 12, 'Witness the indie game revolution and discover the groundbreaking titles and visionary developers reshaping the gaming industry. From narrative-driven adventures to experimental art games, indie games defy conventions.', 'Explore indie gaming revolution.', 1, '2024-04-28 07:16:55', 'published'),
(52, 2, 'Koopals', 12, 'This is a greate movie!', 'This is a greate movie!', 0, '2024-04-28 07:18:24', 'pending_approval'),
(53, 2, 'Tita', 10, 'asdfasdfsadf', 'fasdfasdf', 0, '2024-04-28 07:37:22', 'pending_approval'),
(54, 18, 'Tae', 8, 'TEA', 'asdad', 0, '2024-04-28 07:58:55', 'pending_approval');

-- --------------------------------------------------------

--
-- Table structure for table `posts_replies`
--

CREATE TABLE `posts_replies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `votes` int(11) DEFAULT '0',
  `reply_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts_replies`
--

INSERT INTO `posts_replies` (`id`, `user_id`, `post_id`, `content`, `votes`, `reply_date`) VALUES
(1, 1, 1, 'I agree, climate change is a pressing issue that requires immediate attention.', 5, '2024-05-01 12:30:00'),
(2, 2, 3, 'My favorite movie of all time is The Shawshank Redemption. What about yours?', 11, '2024-05-01 14:30:00'),
(3, 1, 5, 'One tip for a healthier lifestyle is to drink plenty of water throughout the day.', 8, '2024-05-01 16:30:00'),
(4, 2, 6, 'Have you tried resetting your router? Sometimes that helps with connectivity issues.', 6, '2024-05-01 12:30:00'),
(5, 1, 8, 'I recommend upgrading to a solid-state drive (SSD) for faster performance.', 9, '2024-05-01 14:30:00'),
(6, 2, 11, 'Python is a great language for beginners due to its simplicity and readability.', 10, '2024-05-01 12:30:00'),
(7, 1, 13, 'I prefer React for its component-based architecture and virtual DOM.', 12, '2024-05-01 14:30:00'),
(8, 2, 16, 'Responsive web design ensures that websites look and function well on all devices.', 15, '2024-05-01 12:30:00'),
(9, 1, 4, 'My dream travel destination is Japan. I hope to visit Tokyo and Kyoto someday.', 8, '2024-05-01 15:30:00'),
(10, 2, 7, 'One common software error is the \"404 Not Found\" error. Check your URL or file paths.', 14, '2024-05-01 13:30:00'),
(11, 1, 9, 'You can speed up your operating system by disabling unnecessary startup programs.', 8, '2024-05-01 15:30:00'),
(12, 2, 10, 'For data backup, consider using cloud storage services like Google Drive or Dropbox.', 8, '2024-05-01 16:30:00'),
(13, 1, 12, 'Follow the SOLID principles for writing clean and maintainable Java code.', 11, '2024-05-01 13:30:00'),
(14, 2, 15, 'Algorithm optimization techniques include memoization and dynamic programming.', 14, '2024-05-01 16:30:00'),
(15, 1, 17, 'Bootstrap is great for building responsive and mobile-first websites.', 13, '2024-05-01 13:30:00'),
(16, 2, 19, 'Use HTTPS protocol and implement input validation to enhance web application security.', 15, '2024-05-01 15:30:00'),
(17, 1, 21, 'Good UI/UX design considers both aesthetics and user experience to create intuitive interfaces.', 17, '2024-05-01 12:30:00'),
(18, 2, 23, 'Typography plays a crucial role in design, influencing readability and visual appeal.', 19, '2024-05-01 14:30:00'),
(19, 1, 2, 'I recommend \"The Midnight Library\" by Matt Haig. It\'s a thought-provoking read!', 12, '2024-05-01 13:30:00'),
(20, 2, 3, 'My all-time favorite movie is \"The Shawshank Redemption\". It\'s a classic!', 4, '2024-05-01 14:30:00'),
(21, 1, 6, 'Troubleshooting network issues often involves checking your router settings and restarting devices.', 18, '2024-05-01 12:30:00'),
(22, 2, 8, 'For hardware upgrades, consider upgrading your RAM or SSD for improved performance.', 17, '2024-05-01 14:30:00'),
(23, 1, 11, 'Python is a beginner-friendly programming language with a wide range of applications.', 22, '2024-05-01 12:30:00'),
(24, 2, 13, 'React.js is great for building interactive user interfaces, while Vue.js offers simplicity and flexibility.', 24, '2024-05-01 14:30:00'),
(25, 1, 16, 'Responsive web design ensures your website looks good and functions well across various devices and screen sizes.', 12, '2024-05-01 12:30:00'),
(26, 2, 18, 'Node.js is a powerful JavaScript runtime for building scalable and efficient server-side applications.', 28, '2024-05-01 14:30:00'),
(27, 1, 21, 'Good UI/UX design involves understanding user behavior and designing interfaces that meet their needs.', 30, '2024-05-01 12:30:00'),
(28, 2, 25, 'Creative logo designs can help businesses stand out and convey their brand identity effectively.', 32, '2024-05-01 16:30:00'),
(29, 2, 21, 'asdbasdbasdbasdbasdbasdbasdbasdbsadbsbasdbasdb', 0, '2024-04-27 13:08:23'),
(30, 2, 3, 'Putangina ntyong lahat gago!', 14, '2024-04-27 13:09:34'),
(31, 2, 3, 'Hoy putangina mo gago', 1, '2024-04-27 13:16:32'),
(32, 2, 3, 'asdgasdgasdgsdg', 1, '2024-04-27 13:17:54'),
(33, 2, 3, 'afgafdgasdgasg', 6, '2024-04-27 13:19:58'),
(34, 2, 3, 'Radiant Juan', 16, '2024-04-27 13:20:04'),
(35, 2, 3, 'GPIOFOAJS FoiA OIS JFH', 4, '2024-04-27 14:05:32'),
(36, 2, 7, 'sdvabasdfbasbasbasb', -2, '2024-04-27 14:06:18'),
(37, 2, 10, 'tangina mo ', 5, '2024-04-28 04:33:57'),
(38, 2, 20, 'turtle neck', 2, '2024-04-28 05:05:33'),
(39, 2, 39, 'napakawalang kwentang posts', 0, '2024-04-28 06:34:18'),
(40, 2, 53, 'bobo ka!', 2, '2024-04-28 07:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE `private_messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `sent_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `private_messages`
--

INSERT INTO `private_messages` (`id`, `sender_id`, `receiver_id`, `message`, `sent_at`) VALUES
(11, 13, 15, 'Hello user1, how are you today?', '2024-04-28 07:57:12'),
(12, 15, 13, 'Hi admin_user, I\'m doing well, thank you. How about you?', '2024-04-28 07:57:12'),
(13, 13, 14, 'Hey moderator_user, could you help me with an issue I\'m facing?', '2024-04-28 07:57:12'),
(14, 14, 13, 'Of course admin_user, I\'ll do my best to assist you. What seems to be the problem?', '2024-04-28 07:57:12'),
(15, 17, 13, 'Hi admin_user, I have a suggestion for improving the forum.', '2024-04-28 07:57:12'),
(16, 13, 17, 'That sounds great user3! Please share your suggestion with me.', '2024-04-28 07:57:12'),
(17, 19, 13, 'Hello admin_user, I\'m new here and I have a question about the forum rules.', '2024-04-28 07:57:12'),
(18, 13, 19, 'Welcome user5! Feel free to ask your question, I\'m here to help.', '2024-04-28 07:57:12'),
(19, 15, 16, 'Hi user2, do you know how to change profile settings?', '2024-04-28 07:57:12'),
(20, 16, 15, 'Yes, user1. You can change your profile settings in the account settings page.', '2024-04-28 07:57:12'),
(21, 13, 15, 'Hello user1, how are you today?', '2024-04-28 07:58:08'),
(22, 15, 13, 'Hi admin_user, I\'m doing well, thank you. How about you?', '2024-04-28 07:58:08'),
(23, 13, 14, 'Hey moderator_user, could you help me with an issue I\'m facing?', '2024-04-28 07:58:08'),
(24, 14, 13, 'Of course admin_user, I\'ll do my best to assist you. What seems to be the problem?', '2024-04-28 07:58:08'),
(25, 17, 13, 'Hi admin_user, I have a suggestion for improving the forum.', '2024-04-28 07:58:08'),
(26, 13, 17, 'That sounds great user3! Please share your suggestion with me.', '2024-04-28 07:58:08'),
(27, 19, 13, 'Hello admin_user, I\'m new here and I have a question about the forum rules.', '2024-04-28 07:58:08'),
(28, 13, 19, 'Welcome user5! Feel free to ask your question, I\'m here to help.', '2024-04-28 07:58:08'),
(29, 15, 16, 'Hi user2, do you know how to change profile settings?', '2024-04-28 07:58:08'),
(30, 16, 15, 'Yes, user1. You can change your profile settings in the account settings page.', '2024-04-28 07:58:08'),
(31, 18, 14, 'Hey moderator_user, I noticed a bug in the forum interface.', '2024-04-28 07:58:08'),
(32, 14, 18, 'Thanks for letting me know user4. I\'ll forward this to our development team.', '2024-04-28 07:58:08'),
(33, 15, 17, 'Hi user3, do you have any recommendations for learning web development?', '2024-04-28 07:58:08'),
(34, 17, 15, 'Sure user1, I recommend starting with HTML and CSS tutorials on platforms like Codecademy or freeCodeCamp.', '2024-04-28 07:58:08'),
(35, 16, 18, 'Hey moderator_user, I\'m having trouble accessing the forum from my mobile device.', '2024-04-28 07:58:08'),
(36, 18, 16, 'Thanks for reporting user2. We\'ll look into this issue and optimize the mobile experience.', '2024-04-28 07:58:08'),
(37, 19, 17, 'Hello user3, I saw your suggestion about improving the forum. I agree!', '2024-04-28 07:58:08'),
(38, 17, 19, 'Glad you agree user3! Let\'s discuss more ideas for enhancing the community.', '2024-04-28 07:58:08'),
(39, 14, 16, 'Hey user2, could you share your experience with learning JavaScript?', '2024-04-28 07:58:08'),
(40, 16, 14, 'Of course moderator_user. JavaScript can be challenging, but there are many resources available online.', '2024-04-28 07:58:08'),
(41, 18, 15, 'asdfasdfasdf', '2024-04-28 09:52:17'),
(42, 18, 14, 'Hoy tangina mo!', '2024-04-28 09:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','moderator','user') DEFAULT 'user',
  `tier_level` int(11) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `tier_level`, `created_at`, `updated_at`) VALUES
(1, 'Radiant Juan', 'radiantcjuan@gmail.com', '$2y$10$7JCCzXIfhqjCgRylVuYuhOUaS4JRlPJO85fbmzSLtRnlTEqkHwFSW', 'user', 1, '2024-04-24 06:28:45', NULL),
(2, 'Radiant Juanssssss', 'radadmin@gmail.com', '$2y$10$7JCCzXIfhqjCgRylVuYuhOUaS4JRlPJO85fbmzSLtRnlTEqkHwFSW', 'user', 1, '2024-04-24 08:08:46', '2024-04-27 04:42:21'),
(12, 'rjuan', 'radiant.juan@templeandwebster.com.au', '$2y$10$2fSLINRFj6xqNFY.Kdg0wug9q9SAXqXE47oSqBeV3pOY09Iz/Hzma', 'moderator', 1, '2024-04-27 05:10:12', '2024-04-27 14:09:16'),
(13, 'admin_user', 'admin@example.com', '$2y$10$7JCCzXIfhqjCgRylVuYuhOUaS4JRlPJO85fbmzSLtRnlTEqkHwFSW', 'admin', 1, '2024-04-28 07:54:19', NULL),
(14, 'moderator_user', 'moderator@example.com', '$2y$10$7JCCzXIfhqjCgRylVuYuhOUaS4JRlPJO85fbmzSLtRnlTEqkHwFSW', 'moderator', 1, '2024-04-28 07:54:19', NULL),
(15, 'user1', 'user1@example.com', '$2y$10$7JCCzXIfhqjCgRylVuYuhOUaS4JRlPJO85fbmzSLtRnlTEqkHwFSW', 'user', 1, '2024-04-28 07:54:19', NULL),
(16, 'user2', 'user2@example.com', '$2y$10$7JCCzXIfhqjCgRylVuYuhOUaS4JRlPJO85fbmzSLtRnlTEqkHwFSW', 'user', 1, '2024-04-28 07:54:19', NULL),
(17, 'user3', 'user3@example.com', '$2y$10$7JCCzXIfhqjCgRylVuYuhOUaS4JRlPJO85fbmzSLtRnlTEqkHwFSW', 'user', 1, '2024-04-28 07:54:19', NULL),
(18, 'user4', 'user4@example.com', '$2y$10$7JCCzXIfhqjCgRylVuYuhOUaS4JRlPJO85fbmzSLtRnlTEqkHwFSW', 'user', 1, '2024-04-28 07:54:19', NULL),
(19, 'user5', 'user5@example.com', '$2y$10$7JCCzXIfhqjCgRylVuYuhOUaS4JRlPJO85fbmzSLtRnlTEqkHwFSW', 'user', 1, '2024-04-28 07:54:19', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forum_ix_slug` (`slug`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `group_memberships`
--
ALTER TABLE `group_memberships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `posts_forum_fk_1` (`forum_id`);

--
-- Indexes for table `posts_replies`
--
ALTER TABLE `posts_replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `private_messages`
--
ALTER TABLE `private_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forums`
--
ALTER TABLE `forums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `group_memberships`
--
ALTER TABLE `group_memberships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `posts_replies`
--
ALTER TABLE `posts_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `private_messages`
--
ALTER TABLE `private_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD CONSTRAINT `friend_requests_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `friend_requests_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `group_memberships`
--
ALTER TABLE `group_memberships`
  ADD CONSTRAINT `group_memberships_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `group_memberships_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_forum_fk_1` FOREIGN KEY (`forum_id`) REFERENCES `forums` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts_replies`
--
ALTER TABLE `posts_replies`
  ADD CONSTRAINT `posts_replies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_replies_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `private_messages`
--
ALTER TABLE `private_messages`
  ADD CONSTRAINT `private_messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `private_messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
