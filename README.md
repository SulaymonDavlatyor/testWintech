# testWintech
Развертка
docker compose up
php bin/console do:mi:mi
php bin/console doctrine:fixtures:load

SELECT SUM(amount) AS total_refund_amount
FROM wallet_transactions
WHERE reason = 'refund'
  AND created_at >= NOW() - INTERVAL '7 days'



*****

В метод changeBalance передается сумма в виде строки, если требуется отнять, то со знаком минус  - "-1000.00"


