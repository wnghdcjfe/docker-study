[이미지](https://private-user-images.githubusercontent.com/6982437/392705798-aff1a27b-0e97-438f-a8e1-157889f044f9.png?jwt=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJnaXRodWIuY29tIiwiYXVkIjoicmF3LmdpdGh1YnVzZXJjb250ZW50LmNvbSIsImtleSI6ImtleTUiLCJleHAiOjE3MzMzODUyMzYsIm5iZiI6MTczMzM4NDkzNiwicGF0aCI6Ii82OTgyNDM3LzM5MjcwNTc5OC1hZmYxYTI3Yi0wZTk3LTQzOGYtYThlMS0xNTc4ODlmMDQ0ZjkucG5nP1gtQW16LUFsZ29yaXRobT1BV1M0LUhNQUMtU0hBMjU2JlgtQW16LUNyZWRlbnRpYWw9QUtJQVZDT0RZTFNBNTNQUUs0WkElMkYyMDI0MTIwNSUyRnVzLWVhc3QtMSUyRnMzJTJGYXdzNF9yZXF1ZXN0JlgtQW16LURhdGU9MjAyNDEyMDVUMDc0ODU2WiZYLUFtei1FeHBpcmVzPTMwMCZYLUFtei1TaWduYXR1cmU9ZGZkZmY1NjI2YTliZjYyMGUyZDBkNmUxN2I1OTAwOTI4Y2I2ODdiODg5NTc2MzA0NjM4YmI0MWMzODNiMGVhNSZYLUFtei1TaWduZWRIZWFkZXJzPWhvc3QifQ.KnvDUbpxoGxLv6Ggnx6qRRfv6QdwRx7aktrtBKQLIdQ)
## install and start 
```
docker-compose exec php rm -rf /var/www/html/\*
docker-compose exec php composer install
docker-compose down --rmi all -v 
docker-compose build --no-cache
docker-compose up -d 
```  

docker context ls
docker context default
---

## **1. AWS CLI 및 Docker 환경 준비**
1. **AWS CLI 설치**:
   - AWS CLI 설치 및 버전 확인:
     ```bash
     aws --version
     ```

2. **Docker Compose CLI 플러그인 설치 및 확인**:
   ```bash
   docker compose version
   ```
---

## **2. AWS IAM 설정**
1. **필요한 정책을 정의하고 IAM 사용자에게 연결**: 
   - 사용자 정의 정책(JSON):
     ```json
     {
       "Version": "2012-10-17",
       "Statement": [
         {
           "Effect": "Allow",
           "Action": [
             "iam:CreateRole",
             "iam:AttachRolePolicy",
             "iam:PassRole",
             "ecs:*",
             "ecr:*",
             "ec2:*"
             "elasticloadbalancing:*"
           ],
           "Resource": "*"
         }
       ]
     }
     ```
   - 정책을 생성하고 사용자에 연결 

## **3. Amazon ECR 준비** 
#### 예:
```
docker tag <이미지 이름>:<태그> <AWS 계정 ID>.dkr.ecr.<리전>.amazonaws.com/<리포지토리 이름>:<태그> 

docker tag laravel-04-fixed-server:latest 211883824040.dkr.ecr.ap-northeast-2.amazonaws.com/laravel-04-fixed-server:latest
docker tag laravel-04-fixed-php:latest 211883824040.dkr.ecr.ap-northeast-2.amazonaws.com/laravel-04-fixed-php:latest
docker tag laravel-04-fixed-artisan:latest 211883824040.dkr.ecr.ap-northeast-2.amazonaws.com/laravel-04-fixed-artisan:latest
docker tag laravel-04-fixed-composer:latest 211883824040.dkr.ecr.ap-northeast-2.amazonaws.com/laravel-04-fixed-composer:latest

docker push 211883824040.dkr.ecr.ap-northeast-2.amazonaws.com/laravel-04-fixed-server:latest
docker push 211883824040.dkr.ecr.ap-northeast-2.amazonaws.com/laravel-04-fixed-php:latest
docker push 211883824040.dkr.ecr.ap-northeast-2.amazonaws.com/laravel-04-fixed-artisan:latest
docker push 211883824040.dkr.ecr.ap-northeast-2.amazonaws.com/laravel-04-fixed-composer:latest
```


## **4. **Task Definition 생성**:
   - `task.json` 파일을 작성하고 등록:
     ```bash
     aws ecs register-task-definition --cli-input-json file://$(pwd)/task.json
     ```
 

## **5. 그외 네트워크 설정**
1. **VPC 생성**:
   - 새로운 VPC를 생성:
     ```bash
     aws ec2 create-vpc --cidr-block 10.0.0.0/16
     ```

2. **Internet Gateway 생성 및 연결**:
   - 인터넷 게이트웨이 생성 및 VPC에 연결:
     ```bash
     aws ec2 create-internet-gateway
     aws ec2 attach-internet-gateway --internet-gateway-id igw-0c60c2adc4e9e55d6 --vpc-id vpc-083cd7b7698a6b620
     ```

3. **라우팅 테이블 생성 및 설정**:
   - 라우팅 테이블 생성:
     ```bash
     aws ec2 create-route-table --vpc-id vpc-083cd7b7698a6b620
     ```
   - 인터넷 게이트웨이 경로 추가:
     ```bash
     aws ec2 create-route \
       --route-table-id rtb-0aaadc32ab97444da \
       --destination-cidr-block 0.0.0.0/0 \
       --gateway-id igw-0c60c2adc4e9e55d6
     ```

4. **서브넷 생성 및 라우팅 테이블 연결**:
 - 서브넷 확인 : 
 aws ec2 describe-subnets --filters "Name=vpc-id,Values=vpc-083cd7b7698a6b620"
 
   - 서브넷 생성:
     ```bash
     aws ec2 create-subnet --vpc-id vpc-083cd7b7698a6b620 --cidr-block 10.0.1.0/24
     ```
   - 라우팅 테이블 연결:
     ```bash
    aws ec2 associate-route-table \
    --subnet-id subnet-06d10a8234710cc45 \
    --route-table-id rtb-0aaadc32ab97444da 
     ```
 
 