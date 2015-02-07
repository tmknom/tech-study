VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "chef/centos-6.5"
  config.vm.network :private_network, ip: "192.168.0.10"
  config.vm.provision "shell", inline: "yum -y update"

  config.vm.provider :virtualbox do |v|
    # デフォルトのメモリサイズだとメモリが足りないためMySQL5.6が動かない
    # http://nekopunch.hatenablog.com/entry/2014/03/22/020507
    v.customize ["modifyvm", :id, "--memory", 1024]

    # Vagrant+CentOSの組み合わせでネットワークが遅い場合の対策
    # http://qiita.com/s-kiriki/items/357dc585ee562789ac7b
    v.customize ["modifyvm", :id, "--natdnsproxy1", "off"]
    v.customize ["modifyvm", :id, "--natdnshostresolver1", "off"]
  end

end
