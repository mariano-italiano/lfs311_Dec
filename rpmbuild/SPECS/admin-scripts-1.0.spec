Name:           admin-scripts
Version:        1.0
Release:        0
Summary:        Example admin scripts
Packager:       Marcin Kujawski 
Group:          Application/Other
License:        GPL
URL:            www.admin.com/admin-scripts
Source0:        %{name}-%{version}.tar.gz
BuildArch:      noarch

%description
Package installing latest version the admin scripts used by the IT dept.

%prep
%setup -q


%build

%install
rm -rf $RPM_BUILD_ROOT
mkdir -p $RPM_BUILD_ROOT/usr/local/sbin
cp scripts/* $RPM_BUILD_ROOT/usr/local/sbin/

%clean
rm -rf $RPM_BUILD_ROOT

%files
%defattr(-,root,root,-)
%dir /usr/local/sbin
/usr/local/sbin/getosinfo

%doc

%changelog
* Mon May 10 2021 Marcin Kujawski
- release 1.0 - initial release
