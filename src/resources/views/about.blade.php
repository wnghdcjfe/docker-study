<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - 나는 도커 장인이야!!</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }
        header {
            background-color: #1e73be;
            color: white;
            text-align: center;
            padding: 2rem 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            font-size: 2.5rem;
            margin: 0;
        }
        header p {
            margin: 0.5rem 0 0;
            font-size: 1.2rem;
            font-weight: 300;
        }
        main {
            max-width: 1200px;
            margin: 3rem auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        main h2 {
            font-size: 2rem;
            color: #1e73be;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        main p {
            line-height: 1.8;
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
        }
        .image-gallery img {
            width: 100%;
            max-width: 300px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .image-gallery img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
        footer {
            text-align: center;
            padding: 1rem;
            background: #333;
            color: white;
            margin-top: 2rem;
        }
        footer a {
            color: #1e73be;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>나는 도커 장인이야!!</h1>
        <p>Docker로 세상을 바꾸는 기술의 마스터</p>
    </header>
    <main>
        <h2>About Me</h2>
        <p>
            안녕하세요! 저는 Docker 기술에 열정을 가진 개발자입니다. 컨테이너 기술로 애플리케이션의 배포, 확장, 관리를 혁신적으로 수행하는 데 도움을 드립니다. 제 경험과 노하우를 통해 복잡한 환경을 단순화하고, 지속 가능한 인프라를 구축합니다.
        </p>
        <p>
            Docker는 단순한 도구 그 이상입니다. 저는 이를 활용해 생산성을 극대화하고, 현대적인 DevOps 환경을 만들어왔습니다. 도커를 사랑하는 만큼, 이를 널리 전파하는 데에도 기여하고 있습니다.
        </p>
        <div class="image-gallery">
            <img src="https://www.cherryservers.com/v3/assets/blog/2022-12-20/02.png" alt="Docker Image 1">
            <img src="https://miro.medium.com/v2/resize:fit:1400/0*G82uZfX0ozIih3-_" alt="Docker Image 2">
            <img src="https://miro.medium.com/v2/resize:fit:1400/1*bZP17SmwRZihfAYDr5KBFg.png" alt="Docker Image 3">
        </div>
    </main>
    <footer>
        &copy; 2024 Docker Master. Follow me on <a href="https://github.com" target="_blank">GitHub</a>.
    </footer>
</body>
</html>
