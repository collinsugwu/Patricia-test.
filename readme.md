
<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]



<!-- PROJECT LOGO -->
<br />
<p align="center">
  <h3 align="center">Patricia Test</h3>
  <p align="center">
   an authentication system with RSA encryption (that uses public & private key) and also create an extra protected POST route where only encrypted payload is sent which is then decrypted by the application.
    <br />
    <a href="https://github.com/collinsugwu/Patricia-test/blob/master/README.md"><strong>Explore the docs �</strong></a>
    <br />
    <br />
    �
    <a href="https://github.com/collinsugwu/Patricia-test/issues">Report Bug</a>
    �
    <a href="https://github.com/collinsugwu/Patricia-test/issues">Request Feature</a>
  </p>
</p>


<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
* [Usage](#usage)
* [Roadmap](#roadmap)
* [Contributing](#contributing)
* [License](#license)
* [Contact](#contact)
* [Acknowledgements](#acknowledgements)



<!-- ABOUT THE PROJECT -->
## About The Project
<p>Encryption with RSA</p>

<!-- [![Product Name Screen Shot][product-screenshot]](https://example.com) -->
 an authentication system with RSA encryption (that uses public & private key) and also create an extra protected POST route where only encrypted payload is sent which is then decrypted by the application.



### Built With
This progam was made using this technologies
* [Lumen](https://lumen.laravel.com/docs/6.x)
* [JWT](https://jwt.io/)
* [Icobucci/jwt](https://github.com/lcobucci/jwt/blob/3.3/README.md)
* [RSA encryption](https://simple.wikipedia.org/wiki/RSA_algorithm)
* [Swagger Package](https://github.com/DarkaOnLine/SwaggerLume)
* PHPunit Test


<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple example steps.

### Installation

<!-- 1. Get a free API Key at [https://example.com](https://example.com) -->
1. Clone the repo
```sh
git clone https://github.com/collinsugwu/Patricia-test
```
2. cd in to projects directory

```sh
cd Patricia-test
```
3. update/install composer

```sh
composer install
```
4. start the php server

```sh
php -S localhost:8000 -t public
```
5. Publish the endpoints documentation with [DarkaOnline](https://github.com/DarkaOnLine/SwaggerLume)

```sh
  php artisan swagger-lume:publish-config

  php artisan swagger-lume:publish-views 

  php artisan swagger-lume:publish

  php artisan swagger-lume:generate
  
```


<!-- USAGE EXAMPLES -->
## Usage
1. Generate a keyPair(Public and Private key) of key size of 512 bit from [Online RSA Key Generator](http://travistidwell.com/jsencrypt/demo/).

2. create a private_key.pm file and a public_key.pm file in 'storage/keys' folder.

3. copy the private key generated from 'Online RSA Key Generator' into the private_key.pm file, and also copy the public key generated from the 'Online RSA Key Generator' into the public_key.pem file.

4. Run the Test command to test all our endpoints

```sh
vendor/bin/phpunit
```

5. View the endpoints swagger documentaion from this route
```sh
localhost:8000/api/documentation

```

## Explanations
  The Project uses Jwt(Json web token) for authentication but goes a futher in using RSA encryption for encrypting the encoded the base64 jwt token and its payload with a private key and decrypting the token with a public key. 

<!-- ROADMAP -->
## Roadmap

See the [open issues](https://github.com/collinsugwu/Patricia-test/issues) for a list of proposed features (and known issues).


<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.


<!-- CONTACT -->
## Contact


* Collins Ugwu: [Github](https://github.com/collinsugwu), [Twitter](https://twitter.com/collinsugwu_me)

Project Link: [https://github.com/collinsugwu/Patricia-test](https://github.com/collinsugwu/Patricia-test)

<!-- ACKNOWLEDGEMENTS -->


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/collinsugwu/Patricia-test
[contributors-url]: https://github.com/collinsugwu/Patricia-test/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/collinsugwu/Patricia-test
[forks-url]: https://github.com/collinsugwu/Patricia-test/network/members
[stars-shield]: https://img.shields.io/github/stars/collinsugwu/Patricia-test
[stars-url]: https://github.com/collinsugwu/Patricia-test/stargazers
[issues-shield]: https://img.shields.io/github/issues/collinsugwu/Patricia-test
[issues-url]: https://github.com/collinsugwu/Patricia-test/issues
[license-shield]: https://img.shields.io/github/license/collinsugwu/Patricia-test
[license-url]: https://github.com/collinsugwu/Patricia-test/blob/master/LICENSE.txt

