require 'yaml'

def force_sh(cmd)
  begin
    sh cmd
  rescue => e
    puts e.message
  end
end

task:default => [:create_dev]

task :create_dev => [:create_network, :prune] do
  cmd = <<-EOS
    docker-compose build
    docker-compose down
    docker-compose up -d
  EOS
  sh cmd
end

task :create_dev_debug do
  cmd = <<-EOS
    docker-compose build
    docker-compose down
    docker-compose up
  EOS
  sh cmd
end

task :prune do
  force_sh 'docker volume prune -f > /dev/null 2>&1'
  force_sh 'docker rmi -f $(docker images -f "dangling=true" -q) > /dev/null 2>&1'
end

task :create_network do
  force_sh 'docker network create --driver bridge webstream_framework'
end
